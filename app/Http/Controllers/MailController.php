<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\TestMail;
use Mail;

class MailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $details = [
            'title' => $request->subject,
            'body' => $request->message
        ];

        Mail::to($request->email)->send(new TestMail($details));

        return back()->with('success', 'Email sent successfully!');
    }
}


