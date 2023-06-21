<?php

namespace App\Jobs;

use App\Mail\SendOrderEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $email,$name,$cart,$subject;
    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->email = $data['email'];
        $this->name = $data['name'];
        $this->cart = $data['cart'];
        $this->subject = $data['subject'];
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this->email)->send(new SendOrderEmail($this->name,$this->cart,$this->subject));
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
        }
    }
}