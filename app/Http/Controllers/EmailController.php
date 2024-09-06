<?php

// app/Http/Controllers/EmailController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\AttachmentMail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function showForm()
    {
        return view('emailForm');
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
            'attachment' => 'required|file|mimes:pdf,doc,docx,jpg,png'
        ]);

        $details = [
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message
        ];

        $attachment = $request->file('attachment');

        Mail::to($request->email)->send(new AttachmentMail($details, $attachment));

        return back()->with('success', 'Email sent successfully with attachment!');
    }
}
