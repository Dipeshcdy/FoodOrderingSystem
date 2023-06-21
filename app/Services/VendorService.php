<?php

namespace App\Services;

use App\Models\User;
use App\Models\vender;
use App\Models\vendor;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\FuncCall;

class VendorService
{
  public function findId($id)
  {
    return vender::find($id);
  }
  public function pendingVendors()
  {
    //$vendors=vender::where('is_approved',0)->get();
    //  $vendors=User::whereHas('vendor',function($e){
    //     $e->where('is_approved',0);
    //  })->where('is_vendor',1)->get();

    $vendors = User::doesntHave('vendor')->where('is_vendor', 1)->get();
    //dd($vendors);
    return $vendors;
  }
  // public function register($request,$id)
  // {
  //     try{
  //         $request=[
  //           'brand_name' =>'nothing',
  //           'service' =>'nothing',
  //           'image_cover' =>'nothing',
  //           'user_id' =>$id,
  //           'is_approved' =>0,
  //           'is_active'=>1,

  //         ];
  //     vender::create($request);
  //     $response=[
  //       'status'=>'success',
  //       'message'=>'vender created successfully'  
  //     ];
  //     }catch(\Throwable $e)
  //     {
  //         $response=[
  //             'status'=>'error',
  //             'message'=>$e->getMessage() 
  //           ];
  //     }
  //     return $response;
  // }


  // to approve vendors
  public function approve($id)
  {
    try {
      $request = [
        'brand_name' => 'nothing',
        'service' => 'nothing',
        'image_cover' => 'nothing',
        'user_id' => $id,
        'is_approved' => 1,
        'is_active' => 1,

      ];
      vender::create($request);
      $user = User::find($id);
      $user->role_id = 2;
      $user->save();
      $response = [
        'status' => 'success',
        'message' => 'vender approved successfully'
      ];
    } catch (\Throwable $e) {
      $response = [
        'status' => 'error',
        'message' => $e->getMessage()
      ];
    }
    return $response;
  }
  public function reject($id)
  {
    try {
      $data = [
        'is_vendor' => 0,
      ];
      $user = User::find($id);
      $user->update($data);
      //email to vendors
      $response = [
        'status' => 'success',
        'message' => 'vender rejected successfully'
      ];
    } catch (\Throwable $e) {
      $response = [
        'status' => 'error',
        'message' => $e->getMessage()
      ];
    }
    return $response;
  }

  public function approvedVendors()
  {
    $vendors = vender::with('user')->where('is_approved', 1)->get();
    // dd($vendors);
    return $vendors;
  }

  public function check_status_vendor($id)
  {
    try {
      $vendor = vender::find($id);
      //dd($vendor);
      if ($vendor->is_active == 1) {
        $vendor->is_active = 0;
        $vendor->save();
        $response = [
          'status' => 'success',
          'message' => 'vendor deactivated successfully'
        ];
      } else {
        $vendor->is_active = 1;
        $vendor->save();
        $response = [
          'status' => 'success',
          'message' => 'vendor activated successfully'
        ];
      }
    } catch (\Throwable $e) {
      $response = [
        'status' => 'error',
        'message' => $e->getMessage(),
      ];
    }
    return $response;
  }
  public function imageStore($name, $dir)
  {
    $file_name_with_extension = $name->getClientOriginalName();
    $file_name = pathinfo($file_name_with_extension, PATHINFO_FILENAME);
    $extension = $name->getClientOriginalExtension();
    $file_to_store = $file_name . '_' . time() . '.' . $extension;
    $path = $name->storeAs('public/vendor/' . $dir . '/' . $file_to_store);
    return $file_to_store;
  }

  public function UpdateProfile($request, $id)
  {
    $vendor = $this->findId($id);
    try {
      $data = [
        'brand_name' => $request['brand_name'],
        'service' => $request['service'],
      ];
      if ($request->hasFile('logo')) {
        $logo_name = $this->imageStore($request['logo'], 'logo');
        Storage::delete('public/vendor/logo/' . $vendor->logo);
        $data['logo'] = $logo_name;
      }
      if ($request->hasFile('image_cover')) {
        $image_cover_name = $this->imageStore($request['image_cover'], 'image_cover');
        Storage::delete('public/vendor/image_cover/' . $vendor->image_cover);
        $data['image_cover'] = $image_cover_name;
      }
      $vendor->update($data);

      $response = [
        "status" => "success",
        "message" => "Data updated successfully"
      ];
    } catch (\Throwable $e) {
      $response = [
        "status" => "error",
        "message" => $e->getMessage(),
      ];
    }
    return $response;
  }

  public function searchVendor($inputs)
  {
        // $restaurants = User::with('vendor:brand_name,service','product:name,status');
        // $restaurants = $restaurants->whereHas('vendor',function($q) use($inputs){
        //     $q->where('brand_name','LIKE','%'.$inputs['search'].'%')
        //     ->orWhere('service','LIKE','%'.$inputs['search'].'%');
        // })
        // ->orWhereHas('product',function($q) use($inputs){
        //     $q->where('name','LIKE','%'.$inputs['search'].'%')
        //     ->where('status','Available');
        // })
        // ->join('vendors','users.id','vendors.user_id')
        // ->selectRaw('vendors.*')
        // ->orderBy('created_at','DESC')
        // ->get();

        // return $restaurants;

        $restaurants = vender::with('user.product:name,status')
        ->where('is_active',1)
        ->where(function($q) use($inputs){
            $q->where('brand_name','LIKE','%'.$inputs['search'].'%')
            ->orWhere('service','LIKE','%'.$inputs['search'].'%');
        })
        ->orWhereHas('user.product',function($q) use($inputs){
            $q->where('name','LIKE','%'.$inputs['search'].'%')
            ->where('status','Available');
        })
        ->orderBy('created_at','DESC')
        ->get();

        return $restaurants;
  }

  public function getAllProductItems()
  {
    try{
      $content=[];
      $vendors=Vender::where('is_active',1)->get();
      foreach ($vendors as $vendor) {
        $user_id=$vendor->user_id;
        $products=Product::where('user_id',$user_id)->get();
        $index=$vendor->brand_name;
        foreach ($products as $product) {
          $list=[
            'name'=>$product->name,
            'price'=>$product->price
          ];
          $content[$index][]=$list;
        }
      }
      return $content;
    }catch(\Throwable $e)
    {
      return $e->getMessage();
    }
    
  }

}