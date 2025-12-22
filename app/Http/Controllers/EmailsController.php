<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mime\Part\TextPart;


class EmailsController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        $data = $request->only('name', 'email', 'subject', 'message');

        Mail::send([], [], function ($message) use ($data) {
            $message->to('lawis32918@gmail.com')
                ->subject($data['subject'])
                ->setBody(new TextPart(
                    "Name: {$data['name']}\nEmail: {$data['email']}\n\n{$data['message']}",
                    'plain'
                ));
        });


        return response()->json(['message' => 'Email sent successfully']);
    }
}
