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
     *
     * Signature = WAJIB
     * Greeting  = OPTIONAL
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
        | Validate Signature + Greeting
        |--------------------------------------------------------------------------
        |
        | Signature = WAJIB
        | Greeting  = OPTIONAL
        |
        | Kedua-duanya dihantar sebagai PNG Data URL:
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

            'greeting' => [
                'nullable',
                'string',
                'max:1000000',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Validate Signature PNG
        |--------------------------------------------------------------------------
        */

        $signatureData = $validated['signature'];

        if (
            !preg_match(
                '/^data:image\/png;base64,(.+)$/',
                $signatureData,
                $signatureMatches
            )
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Format tandatangan tidak sah.',
            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Decode Signature Base64
        |--------------------------------------------------------------------------
        */

        $signatureImageData = base64_decode(
            $signatureMatches[1],
            true
        );

        if ($signatureImageData === false) {
            return response()->json([
                'success' => false,
                'message' => 'Data tandatangan tidak dapat dibaca.',
            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Pastikan Signature benar-benar PNG
        |--------------------------------------------------------------------------
        */

        if (
            !str_starts_with(
                $signatureImageData,
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
        | Greeting OPTIONAL
        |--------------------------------------------------------------------------
        */

        $greetingImageData = null;

        if (
            isset($validated['greeting']) &&
            filled($validated['greeting'])
        ) {
            $greetingData = $validated['greeting'];

            if (
                !preg_match(
                    '/^data:image\/png;base64,(.+)$/',
                    $greetingData,
                    $greetingMatches
                )
            ) {
                return response()->json([
                    'success' => false,
                    'message' => 'Format ucapan tidak sah.',
                ], 422);
            }

            /*
            |--------------------------------------------------------------------------
            | Decode Greeting Base64
            |--------------------------------------------------------------------------
            */

            $greetingImageData = base64_decode(
                $greetingMatches[1],
                true
            );

            if ($greetingImageData === false) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data ucapan tidak dapat dibaca.',
                ], 422);
            }

            /*
            |--------------------------------------------------------------------------
            | Pastikan Greeting benar-benar PNG
            |--------------------------------------------------------------------------
            */

            if (
                !str_starts_with(
                    $greetingImageData,
                    "\x89PNG\r\n\x1a\n"
                )
            ) {
                return response()->json([
                    'success' => false,
                    'message' => 'Fail ucapan bukan PNG yang sah.',
                ], 422);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Simpan fail + rekod database
        |--------------------------------------------------------------------------
        */

        $signedAt = now();

        $directory = 'signatures/' . $session->event_id;

        /*
        |--------------------------------------------------------------------------
        | Signature filename
        |--------------------------------------------------------------------------
        */

        $signatureFilename =
            'session_' .
            $session->id .
            '_' .
            Str::uuid() .
            '.png';

        $signaturePath =
            $directory .
            '/' .
            $signatureFilename;

        /*
        |--------------------------------------------------------------------------
        | Greeting filename
        |--------------------------------------------------------------------------
        */

        $greetingPath = null;

        if ($greetingImageData !== null) {
            $greetingFilename =
                'session_' .
                $session->id .
                '_greeting_' .
                Str::uuid() .
                '.png';

            $greetingPath =
                $directory .
                '/' .
                $greetingFilename;
        }

        /*
        |--------------------------------------------------------------------------
        | Database Transaction
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $session,
            $signatureImageData,
            $signaturePath,
            $greetingImageData,
            $greetingPath,
            $signedAt
        ) {
            /*
            |--------------------------------------------------------------------------
            | Simpan Signature PNG
            |--------------------------------------------------------------------------
            */

            $signatureStored = Storage::disk('public')->put(
                $signaturePath,
                $signatureImageData
            );

            if (!$signatureStored) {
                throw new \RuntimeException(
                    'Fail tandatangan gagal disimpan.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Simpan Greeting PNG jika ada
            |--------------------------------------------------------------------------
            */

            if ($greetingImageData !== null && $greetingPath !== null) {
                $greetingStored = Storage::disk('public')->put(
                    $greetingPath,
                    $greetingImageData
                );

                if (!$greetingStored) {
                    throw new \RuntimeException(
                        'Fail ucapan gagal disimpan.'
                    );
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Create Signature
            |--------------------------------------------------------------------------
            */

            Signature::create([
                'signing_session_id' => $session->id,
                'signature_path' => $signaturePath,
                'greeting_path' => $greetingPath,
                'signed_at' => $signedAt,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Update Signing Session
            |--------------------------------------------------------------------------
            */

            $session->update([
                'status' => 'signed',
                'signed_at' => $signedAt,
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
                $signaturePath,

            'greeting_path' =>
                $greetingPath,
        ]);
    }
}