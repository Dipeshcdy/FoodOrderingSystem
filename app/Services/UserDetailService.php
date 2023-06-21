<?php

namespace App\Services;
use Illuminate\Support\Facades\Auth;
use App\Models\user_details;


class UserDetailService{

    public function getUserDetail()
    {
        $user_id=Auth::id();
        $userDetails=user_details::where('user_id',$user_id)->orderBy('updated_at','DESC')->get();
        return $userDetails;
    }
    public function addUserDetail($inputs)
    {
        try{
            $user_id=Auth::id();
            user_details::create([
                'address'=>$inputs['address'],
                'phone'=>$inputs['phone'],
                'user_id'=>$user_id,
            ]);
            $response=[
                'status'=>'success',
                'message'=>'Details Added Successfully'
            ];
                
        }catch(\Throwable $e)
        {
            $response=[
                'status'=>'success',
                'message'=>$e->getMessage(),
            ];
        }
        return $response;
    }

    public function deleteUserDetail($id)
    {
        try{
            $user_details=user_details::find($id);
            $user_details->delete();
            $response=[
                'status'=>'success',
                'message'=>'Details Deleted Successfully'
            ];
            
        }catch(\Throwable $e)
        {
            $response=[
                'status'=>'success',
                'message'=>$e->getMessage(),
            ];
        }
        return $response;
    }

    public function updateUserDetail($inputs)
    {
        try{
            $user_details=user_details::find($inputs['id']);
            $data=[
                'address'=>$inputs['address'],
                'phone'=>$inputs['phone'],
                
            ];
            $user_details->update($data);
            $response=[
                "status"=>"success",
                "message"=>"Details updated successfully"
            ];
            
        }catch(\Throwable $e)
        {
            $response=[
                'status'=>'success',
                'message'=>$e->getMessage(),
            ];
            
        }
        return $response;
    }

    
}