<?php

namespace App\services;

use App\Helpers\EmailHelper;
use App\Models\Cart;
use App\Models\Cart_item;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\user_details;

class CartService
{
    public function getCartId($user_id)
    {
        $cart_id=Cart::where('is_checkout',0)->where('user_id',$user_id)->pluck('id')->first();
        return $cart_id;
    }
    public function handleAddToCart($product,$request)
    {
        try {
            $cart = Cart::firstOrCreate(
                [
                    'user_id'=>Auth::id(),
                    'is_checkout'=>0

                ]
            );
            $cart->price += $product->price*$request->qty;
            $cart->save();
            
            $cart_item=Cart_item::updateOrCreate(
                [
                    'cart_id'=>$cart->id,
                    'product_id'=>$product->id,
                ]
                );
            $cart_item->quantity+=$request->qty;
            $cart_item->save();

            $count = $this->getCartCount($cart->id);
            $response = [
                "status"=>"success",
                "message"=>"Added to Cart",
                "item_count"=>$count,
                "status code"=>200
            ];
        } catch (\Throwable $e) {
            $response = [
                "status"=>"error",
                "message"=>$e->getMessage(),
                "item_count"=>0,
                "status code"=>500
            ];
        }

        return $response;

    }

    public function getCartCount($cart_id)
    {
        return Cart_item::where('cart_id',$cart_id)->count();
    }
    public function getCartItems($cart_id)
    {
        
        
        $cartItems=Cart_item::where('cart_id',$cart_id)->with('product')->get();
        return $cartItems;
    }

    public function checkout_cart($inputs)
    {
     try{
        // dd($inputs);
         $cart=Cart::where('id',$inputs['cart_id'])->first();
         $order_id=$cart->id. '-' .date('Y-m-d');
        $cart->is_checkout=1;
        $cart->shipping_address=$inputs['shipping_address'];
        $cart->order_id=$order_id;
        $cart->save();
        // dd($cart->Cart_item);
        
        $data=[
          'name'=>Auth::user()->username,
          'email'=>Auth::user()->email,
          'cart'=>$cart,
          'subject'=>'Items Checked Out'  
        ];
        $deliveryInfo=[
            'name'=>Auth::user()->username,
            'phone'=>Auth::user()->userDetails->phone,
            'location'=>$cart->shipping_address,
        ];
        
        // dd($data);
        $subject="New Order notification";
        $vendorContent=$this->formatVendorContent($cart);
        EmailHelper::sendVendorEmail($vendorContent,$subject,$deliveryInfo);
        EmailHelper::sendEmail($data);
        $response=[
            'message'=>'cart checked out successfully',
            'status'=>'success',
        ];
        
        
     } catch(\Throwable $e)
     {
        $response=[
            'message'=>$e->getMessage(),
            'status'=>'error',
        ];
     } 
     return $response;
    }

    public function formatVendorContent($cart)
    {
        $vendorContent=[];
        foreach ($cart->Cart_item as $item) {
            $product=$item->product;
            //process your item and create an array
                $new=[
                'name'=>$product->name,
                'price'=>$product->price,
                'quantity'=>$item->quantity,
            ];
            $email=$product->user->email; //index where you want to add the array
            $vendorContent[$email][]=$new;
        }
       
        
       return $vendorContent;
    }

    public function cartStatusChange($inputs)
    {
        // dd($inputs['cart_id']);
        try{
            $cart=Cart::find($inputs['cart_id']);
            $cart->status=$inputs['status'];
            $cart->save();
            
            $user=$cart->user;
            // dd($user);
           if ($inputs['status']!='pending') {
            $data=[
                'name'=>$user->username,
                'email'=>$user->email,
                'cart'=>$cart,
                'subject'=>'Item is '.$inputs['status'],  
              ];
            //   dd($data);
            EmailHelper::sendEmail($data);
           }
            
            
            $response=[
                'message'=>'Status Updated successfully',
                'status'=>'success',
            ];
            
        }catch(\Throwable $e)
        {
            $response=[
                'message'=>$e->getMessage(),
                'status'=>'error',
            ];
        }
        return $response;
        
    }



    public function cartItemQuantityUpdate($id,$inputs)
    {
        $cartItem=Cart_item::find($id);
        $productPrice=$cartItem->product->price;
        $cart=$cartItem->cart;
        
        if ($inputs['btn']==='plus') {
            $cartItem->quantity++;
            $cart->price=$cart->price+$productPrice;
            
        }
        elseif($inputs['btn']==='minus')
        {
            $cartItem->quantity--;
            $cart->price=$cart->price-$productPrice;
        }
        $cartItem->save();
        $cart->save();
        $data=[
            'qty'=>$cartItem->quantity,
            'price'=>$cartItem->product->price,
            'totalPrice'=>$cart->price,
            
        ];
        return $data;
    }

    
    public function getUserDetails($id)
    {
        $userDetails =user_details::where('user_id',$id)->get();
        return $userDetails;
    }
}