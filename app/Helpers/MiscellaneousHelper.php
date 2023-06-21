<?php

use App\Models\Cart;
use App\Models\User;
use App\services\CartService;
use Illuminate\Support\Facades\Auth;

function getVendorApprovalStatus($id)
{
   
    $Vendor=User::doesntHave('vendor')->where('is_vendor',1)->where('id',$id)->first();
        if(!empty($Vendor))
        {
            $is_approved=false;
        }
        else{
            $is_approved=true;
            
        }
        return $is_approved;
        

}
function getCartItemsNo(){
    if (Auth::check()) {
        $cartService = new CartService;
        $user_id=Auth::user()->id;
        $cart_id=$cartService->getCartId($user_id);
        $cartItemsNo=$cartService->getCartCount($cart_id);
        return $cartItemsNo;
    }
    else
    {
        return 0;
    }
    
   
}