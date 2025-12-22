<?php

use App\Http\Controllers\EmailsController;
use Illuminate\Support\Facades\Route;

Route::get('/example', function () {
    echo 'My API is Working!';
});

Route::post('/sent-email', [EmailsController::class, 'sendMessage']);
