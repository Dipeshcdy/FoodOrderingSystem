<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use App\Services\SizeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    private $sizeService, $productService;
    public function __construct(SizeService $sizeService, ProductService $productService)
    {
        $this->sizeService = $sizeService;
        $this->productService = $productService;
    }
    public function index()
    {
        $id = Auth::user()->id;
        $products = Product::where('user_id', $id)->get();

        return view('pages.vendor.products.index', compact('products'));
    }

    public function create()
    {
        $sizes = $this->sizeService->findAll();
        return view('pages.vendor.products.create', compact('sizes'));
    }
    public function edit($id)
    {
        $sizes = $this->sizeService->findAll();
        $product = Product::find($id);
        return view('pages.vendor.products.edit', compact('product', 'sizes'));
    }
    public function store(ProductRequest $request)
    {
        //dd($request);

        $id = Auth::user()->id;
        //dd($id);
        $response = $this->productService->addProduct($request, $id);
        if ($response['status'] == 'success') {

            Alert::success($response['status'], $response['message']);
        } else {
            Alert::error($response['status'], $response['message']);
        }
        // dd($response);
        return redirect(route('vendor.product.index'));
    }

    public function update(ProductRequest $request, $id)
    {
        $response = $this->productService->updateProduct($request, $id);
        if ($response['status'] == 'success') {

            Alert::success($response['status'], $response['message']);
        } else {
            Alert::error($response['status'], $response['message']);
        }
        // dd($response);
        return redirect(route('vendor.product.index'));
    }
    

    public function destroy($id)
    {
        $response=$this->productService->destroy($id);
        if($response['status']=='success')
        {
            
            Alert::success($response['status'], $response['message']);
        }
        else
        {
            Alert::error($response['status'], $response['message']);
            
        }
        //dd($slider);
        return redirect(route('vendor.product.index'));
    }
}