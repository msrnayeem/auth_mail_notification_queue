<?php

namespace App\Jobs;

use App\Mail\CustomEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $emailData;

    public function __construct($emailData)
    {
        $this->emailData = $emailData;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $to = $this->emailData['to'];
        $subject = $this->emailData['subject'];
        $body = $this->emailData['body'];
        $attachment = $this->emailData['attachment'];

        // Send the email with the mailable
        Mail::to($to)->send(new CustomEmail($subject, $body));

        // if ($attachment) {
        //     $this->attachFileToEmail($attachment);
        // }
    }

}

    // private function attachFileToEmail($attachment)
    // {
    //     $filename = $attachment->getClientOriginalName();
    //     $path = $attachment->storeAs('attachments', $filename, 'public');

    //     $this->email->attach(
    //         storage_path('app/public/' . $path),
    //         ['as' => $filename]
    //     );
    // }