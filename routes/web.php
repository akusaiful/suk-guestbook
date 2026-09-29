<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SignerController;
use App\Http\Controllers\VisitorRegistrationController;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\GuestbookQrController;
use App\Http\Controllers\SigningSessionController;
use App\Http\Controllers\SigningController;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\SignatureHistoryController;
use App\Http\Controllers\EventThemeController;
use App\Http\Controllers\AdminCommentController;
use App\Http\Controllers\AdminVisitorController;
use App\Http\Controllers\AdminVisitorExportController;
use App\Http\Middleware\PreventBackHistory;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\EventImageController;
use App\Http\Controllers\GuestbookDigitalController;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Login alias untuk middleware auth Laravel
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Admin Authentication — PUBLIC
    |--------------------------------------------------------------------------
    */

    Route::get('/login', [AdminAuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AdminAuthController::class, 'login'])
        ->name('login.submit');


    /*
    |--------------------------------------------------------------------------
    | Admin Protected Area
    |--------------------------------------------------------------------------
    */

    Route::middleware([
        'auth',
        PreventBackHistory::class,
    ])->group(function () {


        /*
        |--------------------------------------------------------------------------
        | Admin Logout
        |--------------------------------------------------------------------------
        */

        Route::post('/logout', function () {

            Auth::logout();

            request()->session()->invalidate();

            request()->session()->regenerateToken();

            return redirect()->route('admin.login');

        })->name('logout');


        /*
        |--------------------------------------------------------------------------
        | Admin Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Live Display — Pilih Event Aktif
        |--------------------------------------------------------------------------
        |
        | Klik menu Live Display akan masuk ke skrin pilihan event dahulu.
        | Hanya event aktif dipaparkan pada skrin pilihan.
        |
        */

        Route::get(
            '/live-display',
            function () {

                $events = \App\Models\Event::query()
                    ->where('is_active', true)
                    ->orderBy('id')
                    ->get();

                return view('admin.live-display.index', [
                    'events' => $events,
                ]);
            }
        )->name('live-display.index');


        /*
        |--------------------------------------------------------------------------
        | Reporting
        |--------------------------------------------------------------------------
        */

        Route::get('/reporting', [AdminReportController::class, 'index'])
            ->name('reporting.index');

        Route::get('/reporting/export', [AdminReportController::class, 'export'])
            ->name('reporting.export');


        /*
        |--------------------------------------------------------------------------
        | Visitors
        |--------------------------------------------------------------------------
        */

        Route::get('/visitors', [AdminVisitorController::class, 'index'])
            ->name('visitors.index');

        Route::get('/visitors/export', [AdminVisitorExportController::class, 'export'])
            ->name('visitors.export');


        /*
        |--------------------------------------------------------------------------
        | Guestbook Digital Melaka
        |--------------------------------------------------------------------------
        |
        | Halaman arkib Guestbook Digital untuk memilih event.
        | Semua event termasuk event lama / tidak aktif boleh dicapai.
        |
        */

        Route::get(
            '/guestbook-digital',
            [GuestbookDigitalController::class, 'index']
        )->name('guestbook-digital.index');


        /*
        |--------------------------------------------------------------------------
        | Event Management
        |--------------------------------------------------------------------------
        */

        Route::resource('events', EventController::class)
            ->except(['show']);


        /*
        |--------------------------------------------------------------------------
        | Event Images — Pilih Event
        |--------------------------------------------------------------------------
        |
        | Klik menu Gambar Event akan masuk ke halaman pilih event dahulu.
        |
        */

        Route::get(
            '/events/images',
            [EventImageController::class, 'chooseEvent']
        )->name('events.images.choose');


        /*
        |--------------------------------------------------------------------------
        | Event Images
        |--------------------------------------------------------------------------
        |
        | Pengurusan gambar untuk event yang telah dipilih.
        |
        */

        Route::get(
            '/events/{event}/images',
            [EventImageController::class, 'index']
        )->name('events.images.index');

        Route::post(
            '/events/{event}/images',
            [EventImageController::class, 'store']
        )->name('events.images.store');

        Route::delete(
            '/events/{event}/images/{eventImage}',
            [EventImageController::class, 'destroy']
        )->name('events.images.destroy');


        /*
        |--------------------------------------------------------------------------
        | Event QR
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/events/{event}/qr',
            [GuestbookQrController::class, 'show']
        )->name('events.qr');


        /*
        |--------------------------------------------------------------------------
        | Event Theme
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/events/{event}/theme',
            [EventThemeController::class, 'edit']
        )->name('events.theme.edit');

        Route::put(
            '/events/{event}/theme',
            [EventThemeController::class, 'update']
        )->name('events.theme.update');


        /*
        |--------------------------------------------------------------------------
        | Signer Management
        |--------------------------------------------------------------------------
        */

        Route::resource('signers', SignerController::class)
            ->except(['show']);


        /*
        |--------------------------------------------------------------------------
        | Signing Session
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/events/{event}/signing',
            [SigningSessionController::class, 'index']
        )->name('events.signing');

        Route::post(
            '/events/{event}/signing/{signer}/add',
            [SigningSessionController::class, 'addSigner']
        )->name('events.signing.add');

        Route::post(
            '/events/{event}/signing/{signer}/remove',
            [SigningSessionController::class, 'removeSigner']
        )->name('events.signing.remove');

        Route::post(
            '/events/{event}/signing/{signer}',
            [SigningSessionController::class, 'requestSign']
        )->name('events.signing.request');

        Route::post(
            '/events/{event}/signing/{signer}/clear',
            [SigningSessionController::class, 'clearSign']
        )->name('events.signing.clear');

        Route::post(
            '/events/{event}/signing/{signer}/cancel',
            [SigningSessionController::class, 'cancelSign']
        )->name('events.signing.cancel');


        /*
        |--------------------------------------------------------------------------
        | Signature
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/events/{event}/signing/{signer}/signature',
            [SigningSessionController::class, 'showSignature']
        )->name('events.signing.signature');


        /*
        |--------------------------------------------------------------------------
        | Signature History
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/events/{event}/signing/{signer}/history',
            [SignatureHistoryController::class, 'signerHistory']
        )->name('events.signing.history');

        Route::delete(
            '/events/{event}/signing/{signer}/history/{signature}',
            [SignatureHistoryController::class, 'destroy']
        )->name('events.signing.history.delete');


        /*
        |--------------------------------------------------------------------------
        | All Signature Records
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/signatures',
            [SignatureHistoryController::class, 'index']
        )->name('signatures.index');


        /*
        |--------------------------------------------------------------------------
        | DELETE SIGNATURE
        |--------------------------------------------------------------------------
        */

        Route::delete(
            '/signatures/{signature}',
            function ($signature) {

                $record = DB::table('signatures')
                    ->where('id', $signature)
                    ->first();


                if (!$record) {

                    return redirect()
                        ->route('admin.signatures.index')
                        ->with(
                            'error',
                            'Rekod tandatangan tidak dijumpai.'
                        );
                }


                if (!empty($record->signature_path)) {

                    Storage::disk('public')
                        ->delete($record->signature_path);
                }


                DB::table('signatures')
                    ->where('id', $signature)
                    ->delete();


                return redirect()
                    ->route('admin.signatures.index')
                    ->with(
                        'success',
                        'Rekod tandatangan berjaya dipadam.'
                    );

            }
        )->name('signatures.destroy');


        /*
        |--------------------------------------------------------------------------
        | Comment Management
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/comments',
            [AdminCommentController::class, 'index']
        )->name('comments.index');

        Route::delete(
            '/comments/{comment}',
            [AdminCommentController::class, 'destroy']
        )->name('comments.destroy');

    });

});


/*
|--------------------------------------------------------------------------
| Public Guestbook - Visitor
|--------------------------------------------------------------------------
*/

Route::get(
    '/guestbook/{event}/register',
    [VisitorRegistrationController::class, 'create']
)->name('guestbook.register');

Route::post(
    '/guestbook/{event}/register',
    [VisitorRegistrationController::class, 'store']
)->name('guestbook.register.store');

Route::get(
    '/guestbook/{event}/thank-you',
    [VisitorRegistrationController::class, 'thankYou']
)->name('guestbook.thank-you');


/*
|--------------------------------------------------------------------------
| Public Guestbook - Display
|--------------------------------------------------------------------------
*/

Route::get(
    '/guestbook/{event}/display',
    [DisplayController::class, 'show']
)->name('guestbook.display');


/*
|--------------------------------------------------------------------------
| Public Guestbook - Digital Guestbook
|--------------------------------------------------------------------------
*/

Route::get(
    '/guestbook-digital/{event}',
    [GuestbookDigitalController::class, 'show']
)->name('guestbook-digital.show');


/*
|--------------------------------------------------------------------------
| Public Guestbook - Signing Tablet
|--------------------------------------------------------------------------
*/

Route::get(
    '/guestbook/{event}/sign',
    [SigningController::class, 'tablet']
)->name('guestbook.sign');


/*
|--------------------------------------------------------------------------
| Public Guestbook - Signature Submit
|--------------------------------------------------------------------------
*/

Route::post(
    '/guestbook/signing-sessions/{session}/signature',
    [SignatureController::class, 'store']
)->name('guestbook.signature.store');


/*
|--------------------------------------------------------------------------
| Temporary Test Route
|--------------------------------------------------------------------------
*/

Route::get('/test-temp', function () {

    $tempDir = sys_get_temp_dir();

    return response()->json([
        'temp_dir' => $tempDir,
        'is_dir' => is_dir($tempDir),
        'is_writable' => is_writable($tempDir),
        'php_sapi' => PHP_SAPI,
        'upload_tmp_dir' => ini_get('upload_tmp_dir'),
        'sys_temp_dir' => ini_get('sys_temp_dir'),
    ]);

});