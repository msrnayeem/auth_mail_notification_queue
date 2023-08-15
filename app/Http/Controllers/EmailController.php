<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function submitSelectedUsers(Request $request)
    {
        $selected = explode(',', $request->input('selectedUserIds'));
        //  dd($selected);
        return view('emails.compose', ['toEmails' => $selected]);
    }

    public function sendEmail(Request $request)
    {
        $to = $request->input('to');
        $subject = $request->input('subject');
        $body = $request->input('body');
        $attachment = $request->file('attachment');

        $emailData = [
            'to' => $to,
            'subject' => $subject,
            'body' => $body,
            'attachment' => $attachment,
        ];

        // Send the email using a job
        SendEmailJob::dispatch($emailData);

        return redirect()->back()->with('success', 'Email sent successfully!');
    }
}
