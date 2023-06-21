<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\vender;
use App\Services\ProductService;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    private $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService=$productService;
    }
    public function index($id)
    {
        $vendor=vender::find($id);
        //dd($vendor);
        $user_id=$vendor->user_id;
        $products=$this->productService->findByUserId($user_id);
        //   dd($products);
        return view('pages.client.restaurant.index',compact('vendor','products'));
    }
}