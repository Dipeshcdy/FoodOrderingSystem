<?php
namespace App\Helpers;

use App\Jobs\EmailJob;
use App\Jobs\VendorEmailJob;
use Illuminate\Support\Facades\Log;

class EmailHelper{
public static function sendEmail($data)
{
    // dd($data);
    try{
        $emailJob=(new EmailJob($data));
        // dd($emailJob);
        dispatch($emailJob);
        
    }catch(\Throwable $e)
    {
        Log::error($e->getMessage());
    }
}
public static function sendVendorEmail($vendorContent,$subject,$deliveryInfo)
{
    try {
         //dd($vendorContent);
        foreach ($vendorContent as $email => $content) {
            $vendorEmailJob=(new VendorEmailJob($email,$content,$subject,$deliveryInfo));
            dispatch($vendorEmailJob);
        }
    } catch (\Throwable $e) {
        Log::error($e->getMessage());
    }
}

// public static function sendP

    
}


?>