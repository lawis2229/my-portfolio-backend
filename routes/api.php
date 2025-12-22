<?php

use App\Http\Controllers\EmailsController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Mime\Part\TextPart;
use Illuminate\Support\Facades\Mail;


Route::get('/example', function () {
    echo 'My API is Working!';
});

Route::get('/example-production', function () {
    echo 'My API is Working in Production!';
});

Route::post('/sent-email', [EmailsController::class, 'sendMessage']);

Route::post('/example-sent-email', function () {
    $data = [
        'name' => 'Ryanle Lawis',
        'email' => 'ryan@gmail.com',
        'message' => 'Hello! Message Received!'
    ];

    Mail::send([], [], function ($message) use ($data) {
        $message->to('lawis32918@gmail.com')
            ->subject('About your Portfolio')
            ->setBody(new TextPart(
                "Name: {$data['name']}\nEmail: {$data['email']}\n\n{$data['message']}",
                'plain'
            ));
    });

    return response()->json(['message' => 'Email sent successfully']);
});
