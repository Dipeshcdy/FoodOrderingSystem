<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SizeRequest;
use App\Services\SizeService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class SizeController extends Controller
{
    private $SizeService;

    public function __construct(SizeService $service)
    {
        $this->SizeService=$service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product_sizes=$this->SizeService->findAll();
        
        return view('pages.admin.products.product-size.index',compact('product_sizes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.products.product-size.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SizeRequest $request)
    {
        $response=$this->SizeService->addSize($request);
        if($response['status']=='success')
        {
            
            Alert::success($response['status'], $response['message']);
        }
        else
        {
            Alert::error($response['status'], $response['message']);
            
        }
       // dd($response);
        return redirect('product_size');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product_size=$this->SizeService->findId($id);
        return view('pages.admin.products.product-size.edit',compact('product_size'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SizeRequest $request, string $id)
    {
        $response=$this->SizeService->updateSize($request,$id);
        if($response['status']=='success')
        {
            
            Alert::success($response['status'], $response['message']);
        }
        else
        {
            Alert::error($response['status'], $response['message']);
            
        }
        return redirect('product_size');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response=$this->SizeService->destroy($id);
        if($response['status']=='success')
        {
            
            Alert::success($response['status'], $response['message']);
        }
        else
        {
            Alert::error($response['status'], $response['message']);
            
        }
        //dd($slider);
        return redirect('product_size');
    }
}