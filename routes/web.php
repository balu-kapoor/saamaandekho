<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use Illuminate\Support\Facades\Artisan;

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('optimize:clear');

    return 'Cache cleared successfully';
});

Route::get('/send-test-email', function () {
    \Illuminate\Support\Facades\Mail::to('brkapoor11@gmail.com')->send(new \App\Mail\TestMail());
    return 'Test email sent successfully!';
});
