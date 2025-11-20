<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailVerificationController;

Route::get('/emailchecked', function () {
    return view('emailChecked');
});

Route::get('email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware('signed')
->name('verification.verify');
