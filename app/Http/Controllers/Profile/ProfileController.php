<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\passwordChangeRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\VendorRequest;
use App\Services\VendorService;
use App\Models\User;
use App\Services\ProfileService;
use Illuminate\Http\Request;
// use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert as Alert;

class ProfileController extends Controller
{
    private $vendorService,$profileService;
    public function __construct(VendorService $vendorService,ProfileService $profileService)
    {
        $this->vendorService=$vendorService;
        $this->profileService=$profileService;
    }
    public function profile()
    {
        $profile=auth()->user();
         //dd($profile->vendor->id);
        return view('pages.setting.profile',compact('profile'));
    }
    public function clientProfile()
    {
        $id=auth()->user()->id;
        $profile=User::with('userDetails')->find($id);
        
        // dd($profile);
        if($profile->userDetails)
        {
            return view('pages.client.setting.profile',compact('profile'));
        }
        else
        {
            Alert::error('error', 'please fill the phone and address first');
            return redirect(route('user.detail'));
        }
         //dd($profile->vendor->id);
    }
    public function changePasswordIndex()
    {
        $profile=auth()->user();
        return view('pages.setting.changePassword',compact('profile'));
    }
    public function clientChangePasswordIndex()
    {
        $profile=auth()->user();
        return view('pages.client.setting.changePassword',compact('profile'));
    }
    public function changePassword(passwordChangeRequest $request,$id)
    {
        $user=Auth::user();
        $inputs=$request->all();
            
        $response=$this->profileService->changePassword($inputs);
        if($response['status']=='success')
        {
                
            Alert::success($response['status'], $response['message']);
        }
        else
        {
            Alert::error($response['status'], $response['message']);
                
        }
        if($user->role->role==="admin")
        {
                
            return redirect(route('admin.profile'));
        }
        else{
                
            return redirect(route('vendor.profile'));
        }
    }
    public function update(VendorRequest $request,$id)
    {
        //dd($request);
        
       $response=$this->vendorService->UpdateProfile($request,$id);
       if($response['status']=='success')
        {
            
            Alert::success($response['status'], $response['message']);
        }
        else
        {
            Alert::error($response['status'], $response['message']);
            
        }
        return redirect(route('vendor.profile'));
    }

    public function userDetail()
    {
        return view('pages.setting.userDetail');
    }
}