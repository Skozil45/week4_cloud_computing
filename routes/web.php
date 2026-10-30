<?php

use App\Http\Controllers\PictureEmailController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('postcards', ['pictures' => config('postcards')]);
})->name('home');

Route::post('/email-picture', PictureEmailController::class)
    ->middleware('throttle:3,1')
    ->name('picture.send');
