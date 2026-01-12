<?php

namespace App\Jobs;

use App\Mail\BulkEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendBulkEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $recipient;
    protected $emailDetails;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($recipient, $emailDetails)
    {
        $this->recipient = $recipient;
        $this->emailDetails = $emailDetails;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->recipient)->send(new BulkEmail($this->emailDetails));
    }
}
