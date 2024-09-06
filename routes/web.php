<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\EmailController;


// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('email-form', function () {
//     return view('emailForm');
// });

Route::get('/lgn', function () {
    return view('login');
});

Route::post('/login', function () {
    return redirect('/prank');
});

Route::get('/prank', function () {
    return view('prank');
});
Route::get('/vrs', function () {
    return view('virusAlert');
});
Route::get('/', function () {
    return view('hackingPrank');
});


Route::get('/posts', [PostController::class, 'index']);
Route::post('/posts', [PostController::class, 'store']);
Route::get('/posts/{id}', [PostController::class, 'show']);
Route::put('/posts/{id}', [PostController::class, 'update']);
Route::delete('/posts/{id}', [PostController::class, 'destroy']);

Route::post('send-email', [MailController::class, 'sendEmail']);

Route::get('/email-form', [EmailController::class, 'showForm']);
Route::post('/send-email', [EmailController::class, 'sendEmail']);
