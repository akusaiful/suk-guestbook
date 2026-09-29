<?php

namespace App\Http\Controllers;

use App\Models\Signature;
use App\Models\SigningSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SignatureController extends Controller
{
    /**
     * Simpan tandatangan digital untuk signing session.
     */
    public function store(
        Request $request,
        SigningSession $session
    ): JsonResponse {
        /*
        |--------------------------------------------------------------------------
        | Pastikan sesi masih aktif untuk tandatangan
        |--------------------------------------------------------------------------
        */

        if ($session->status !== 'signing') {
            return response()->json([
                'success' => false,
                'message' => 'Sesi tandatangan ini sudah tidak aktif.',
            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | Elakkan tandatangan berganda untuk session yang sama
        |--------------------------------------------------------------------------
        */

        if ($session->signature()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Tandatangan untuk sesi ini sudah direkodkan.',
            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | Validate Signature
        |--------------------------------------------------------------------------
        |
        | Tandatangan dihantar sebagai:
        |
        | data:image/png;base64,....
        |
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'signature' => [
                'required',
                'string',
                'max:1000000',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Pastikan format ialah PNG Data URL
        |--------------------------------------------------------------------------
        */

        $signatureData = $validated['signature'];


        if (
            !preg_match(
                '/^data:image\/png;base64,(.+)$/',
                $signatureData,
                $matches
            )
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Format tandatangan tidak sah.',
            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | Decode Base64
        |--------------------------------------------------------------------------
        */

        $imageData = base64_decode(
            $matches[1],
            true
        );


        if ($imageData === false) {
            return response()->json([
                'success' => false,
                'message' => 'Data tandatangan tidak dapat dibaca.',
            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | Pastikan data PNG benar-benar bermula dengan PNG signature
        |--------------------------------------------------------------------------
        */

        if (
            !str_starts_with(
                $imageData,
                "\x89PNG\r\n\x1a\n"
            )
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Fail tandatangan bukan PNG yang sah.',
            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | Simpan fail + rekod database
        |--------------------------------------------------------------------------
        */

        $signedAt = now();


        $directory =
            'signatures/' .
            $session->event_id;


        $filename =
            'session_' .
            $session->id .
            '_' .
            Str::uuid() .
            '.png';


        $path =
            $directory .
            '/' .
            $filename;


        DB::transaction(function () use (
            $session,
            $imageData,
            $path,
            $signedAt
        ) {

            /*
            |--------------------------------------------------------------------------
            | Simpan PNG
            |--------------------------------------------------------------------------
            */

            $stored =
                Storage::disk('public')->put(
                    $path,
                    $imageData
                );


            if (!$stored) {

                throw new \RuntimeException(
                    'Fail tandatangan gagal disimpan.'
                );

            }


            /*
            |--------------------------------------------------------------------------
            | Create Signature
            |--------------------------------------------------------------------------
            */

            Signature::create([
                'signing_session_id' =>
                    $session->id,

                'signature_path' =>
                    $path,

                'signed_at' =>
                    $signedAt,
            ]);


            /*
            |--------------------------------------------------------------------------
            | Update Signing Session
            |--------------------------------------------------------------------------
            */

            $session->update([
                'status' =>
                    'signed',

                'signed_at' =>
                    $signedAt,
            ]);

        });


        /*
        |--------------------------------------------------------------------------
        | Response
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'success' => true,

            'message' =>
                'Tandatangan berjaya direkodkan.',

            'session_id' =>
                $session->id,

            'status' =>
                'signed',

            'signed_at' =>
                $signedAt->toIso8601String(),

            'signature_path' =>
                $path,
        ]);
    }
}