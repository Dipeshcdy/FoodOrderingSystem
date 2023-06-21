<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\VendorService;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class VendorController extends Controller
{
    private $VendorService;
    public function __construct(VendorService $service)
    {
        $this->VendorService=$service;
    } 
    public function pendingVendors()
    {
        $pending_vendors=$this->VendorService->pendingVendors();
        return view('pages.admin.vendors.pendingVendors',compact('pending_vendors'));
    }
    public function approvedVendors()
    {
        $approved_vendors=$this->VendorService->approvedVendors();
        return view('pages.admin.vendors.approvedVendors',compact('approved_vendors'));
    }
    public function approve($id)
    {
        $response=$this->VendorService->approve($id);
        if($response['status']=='success')
        {
            
            Alert::success($response['status'], $response['message']);
        }
        else
        {
            Alert::error($response['status'], $response['message']);
            
        }
        return redirect(route('vendor.pending'));
    }
    public function reject($id)
    {
        $response=$this->VendorService->reject($id);
        if($response['status']=='success')
        {
            
            Alert::success($response['status'], $response['message']);
        }
        else
        {
            Alert::error($response['status'], $response['message']);
            
        }
        return redirect(route('vendor.pending'));
    }
    
    
    public function check_status_vendor($id)
    {
        $response=$this->VendorService->check_status_vendor($id);
        if($response['status']=='success')
        {
            
            Alert::success($response['status'], $response['message']);
        }
        else
        {
            Alert::error($response['status'], $response['message']);
            
        }
        return redirect(route('vendor.approved'));
    }
    
    public function getAllProductItems()
    {
        $vendorProducts=$this->VendorService->getAllProductItems();
        // dd($response);
        // dd($vendorProducts);
        return view('pages.admin.products.product-items.index',compact('vendorProducts'));
    }
   
    
}