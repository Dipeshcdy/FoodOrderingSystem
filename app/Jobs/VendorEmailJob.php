<?php

namespace App\Jobs;

use App\Mail\SendVendorEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class VendorEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $email,$content,$subject,$deliveryInfo;
    /**
     * Create a new job instance.
     */
    public function __construct($email,$content,$subject,$deliveryInfo)
    {
        $this->email=$email;
        $this->content=$content;
        $this->subject=$subject;
        $this->deliveryInfo=$deliveryInfo;
        
        
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this->email)->send(new SendVendorEmail($this->content,$this->subject,$this->deliveryInfo));
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
        }
    }
}