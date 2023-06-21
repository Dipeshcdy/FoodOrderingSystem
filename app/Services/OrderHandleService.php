<?php

namespace App\Services;
use App\Models\Cart;
use App\Models\Cart_item;
use Illuminate\Support\Facades\Auth;
class OrderHandleService
{
    public function adminPendingOrders()
    {
        $data=Cart::where([['status','pending'],['is_checkout',1]])->orderBy('updated_at','DESC')->get();
        // dd($data);
        return $data;
        
    }
    public function adminPendingOrdersItem($cart_id)
    {
        $content=[];
        $data=Cart_item::where('cart_id',$cart_id)->get();
        foreach ($data as $item) {
            $product=$item->product;
            $user=$product->user;
            $name=$user->username;
            $new=[
                'name'=>$product->name,
                'price'=>$product->price,
                'qty'=>$item->quantity,
                'username'=>$name,
            ];
            $brand_name=$user->vendor->brand_name;
            $content[$brand_name][]=$new;
        }
        // dd($content);
        return $content;
    }
    public function adminProcessedOrders()
    {
        $data=Cart::where([['status','processed'],['is_checkout',1]])->orderBy('updated_at','DESC')->get();
        return $data;
    }
    
        public function vendorPendingOrders()
        {
            $content=[];
            $user_id=Auth::id();
            // dd($user_id);
            $data=Cart::where([['status','pending'],['is_checkout',1]])->orderBy('updated_at','DESC')->get();
            // dd($data);
            foreach ($data as $item) {
                $cartItems=$item->Cart_item;
                //dd($cartItems);
                foreach ($cartItems as $cartItem) {
                    $u_id=$cartItem->product->user_id;
                    // dd($u_id);
                    if($user_id==$u_id)
                        {
                            $content[]=$item;
                            break;
                        }
                }
                
            }
            return $content;
        }

        public function vendorPendingOrdersItem($cart_id)
        {
            $content=[];
            $user_id=Auth::id();
            $data=Cart_item::where('cart_id',$cart_id)->get();
            foreach ($data as $item) {
                $product=$item->product;
                $u_id=$product->user_id;
                if($user_id == $u_id)
                {
                    $new=[
                        'name'=>$product->name,
                        'price'=>$product->price,
                        'qty'=>$item->quantity,
                    ];
                    $content[]=$new;
                    
                }
                
            }
            return $content;
            
        }
        public function vendorProcessedOrders()
        {
            $content=[];
            $user_id=Auth::id();
            // dd($user_id);
            $data=Cart::where([['status','processed'],['is_checkout',1]])->orderBy('updated_at','DESC')->get();
            // dd($data);
            foreach ($data as $item) {
                $cartItems=$item->Cart_item;
                //dd($cartItems);
                foreach ($cartItems as $cartItem) {
                    $u_id=$cartItem->product->user_id;
                    // dd($u_id);
                    if($user_id==$u_id)
                        {
                            $content[]=$item;
                            break;
                        }
                }
                
            }
            return $content;
        }
    
}


?>