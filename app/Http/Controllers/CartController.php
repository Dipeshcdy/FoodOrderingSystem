<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\services\CartService;
use App\services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
// use App\Models\user_details;

class CartController extends Controller
{
    private $productService,$cartService;
    public function __construct(ProductService $productService,CartService $cartService)
    {
        $this->productService = $productService;
        $this->cartService = $cartService;
    }
    public function addToCart(Request $request,$product_id)
    {
        
        
        $product = $this->productService->findById($product_id);
        if (!empty($product)) {
            $response = $this->cartService->handleAddToCart($product,$request);
        }
        else{
            $response = [
                "status"=>"error",
                "message"=>"Product can not added to cart!",
                "status code"=>422
            ];
        }
        return response()->json($response,$response['status code']);
    }
    
    public function cartItem()
    {
        $id=Auth::id();
        $cart_id=$this->cartService->getCartId($id);
        $cartItems=$this->cartService->getCartItems($cart_id);
        $userDetails=$this->cartService->getUserDetails($id);
        // dd($cartItems);
        return view('pages.client.cart_items',compact('cartItems','userDetails'));
    }
    public function checked_out(Request $request)
    {
        $inputs=$request->all();
        // dd($inputs);
        $response=$this->cartService->checkout_cart($inputs);
         if($response['status']=='success')
        {
            
            Alert::success($response['status'], $response['message']);
        }
        else
        {
            Alert::error($response['status'], $response['message']);
            
        }
        return redirect()->back();
    }

    public function cartStatusChange(Request $request)
    {
        $inputs=$request->all();
        // dd($inputs);
        $response=$this->cartService->cartStatusChange($inputs);
        if($response['status']=='success')
        {
            
            Alert::success($response['status'], $response['message']);
        }
        else
        {
            Alert::error($response['status'], $response['message']);
            
        }
        return redirect()->back();

    }



    public function cartItemQuantityUpdate(Request $request,$id)
    {
        $inputs=$request->all();
        // dd($inputs);
        $response=$this->cartService->cartItemQuantityUpdate($id,$inputs);
        // $response=
        return response()->json($response);
    }
}