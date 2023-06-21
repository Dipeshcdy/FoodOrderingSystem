<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\vender;
use App\Services\SliderService;
use App\Services\VendorService;
use Illuminate\Http\Request;

class MainController extends Controller
{
  private $vendorService;
  public function __construct(VendorService $vendorService)
  {
    $this->vendorService=$vendorService;
  }
 public function index(){
   $slider=new SliderService();
   $sliders=$slider->findAll();
    return view('main',compact('sliders'));
 }
 public function restaurant(){
  $res=vender::where('is_active',1)->orderBy('created_at','DESC')->get();
  //dd($res);
  return view('pages.client.restaurant',compact('res'));
 }
 public function cartItem()
 {
  
 }

public function search(Request $request)
    {
        $inputs = $request->all();
        $res = $this->vendorService->searchVendor($inputs);
        $key = $inputs['search'];
        return view('pages.client.restaurant',compact('res','key'));

    }
}