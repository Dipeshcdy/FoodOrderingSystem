<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserDetailRequest;
use App\Services\UserDetailService;
use RealRashid\SweetAlert\Facades\Alert;


use Illuminate\Http\Request;

class UserDetailController extends Controller
{
    private $userDetailService;
    public function __construct(UserDetailService $userDetailService)
    {
        $this->userDetailService=$userDetailService;
    }
    public function getUserDetail()
    {
        $userDetails=$this->userDetailService->getUserDetail();
        // dd($userDetails);
        return view('pages.client.user_details',compact('userDetails'));
        
    }

    public function getAdminVendorUserDetail()
    {
        $userDetails=$this->userDetailService->getUserDetail();
        // dd($userDetails);
        return view('pages.setting.userDetail',compact('userDetails'));
    }
    
    public function addUserDetail(UserDetailRequest $request)
    {
        $inputs=$request->all();
        // dd($inputs);
        $response=$this->userDetailService->addUserDetail($inputs);
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

    public function deleteUserDetail($id)
    {
        $response=$this->userDetailService->deleteUserDetail($id);
        // dd($id);
        if($response['status'] == 'success')
        {
            
            Alert::success($response['status'], $response['message']);
        }
        else
        {
            Alert::error($response['status'], $response['message']);
            
        }
        return redirect()->back();
    }

    public function updateUserDetail(Request $request)
    {
        $inputs=$request->all();
        // dd($inputs)
        $response=$this->userDetailService->updateUserDetail($inputs);
        if($response['status'] == 'success')
        {
            
            Alert::success($response['status'], $response['message']);
        }
        else
        {
            Alert::error($response['status'], $response['message']);
            
        }
        return redirect()->back();
    }
}