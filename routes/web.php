<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\JobCartePdfController;

use App\Http\Controllers\JobCarteSignatureController;

Route::get('/', function () {
    return view('welcome');
});

Route::get(
    '/job-cartes/{record}/pdf',
    [JobCartePdfController::class, 'generate']
)->name('job-cartes.pdf');

Route::get(
    '/job-carte/sign/{token}',
    [JobCarteSignatureController::class, 'show']
)->name('job-carte.signature');

Route::post(
    '/job-carte/sign/{token}',
    [JobCarteSignatureController::class, 'sign']
)->name('job-carte.signature.sign');

Route::get('/job-carte/signature/success', function () {
    return view('job-cartes.signature-success');
})->name('job-carte.signature.success');

Route::get('/job-carte/signature/unavailable', function () {
    return response()->view(
        'job-cartes.signature-unavailable',
        [],
        409
    );
})->name('job-carte.signature.unavailable');