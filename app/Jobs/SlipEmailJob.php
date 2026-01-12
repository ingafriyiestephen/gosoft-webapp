<?php

namespace App\Jobs;

use App\Mail\SlipMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SlipEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $recipient;
    protected $emailDetails;

    /**
     * Create a new job instance.
     */
    //public function __construct($data)
    //{
       // $this->data = $data;
    //}

    public function __construct($recipient, $emailDetails)
    {
        $this->recipient = $recipient;
        $this->emailDetails = $emailDetails;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        Mail::to($this->recipient)->send(new SlipMail($this->emailDetails));
    }
}
