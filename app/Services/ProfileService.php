<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class ProfileService{
    
    public function changePassword($inputs)
    {
        $user=Auth::user();
       try{
        $user->password=Hash::make($inputs['password']);
        $user->save();
        $response=[
            "status"=>"success",
            "message"=>"Password Updated successfully"
        ];
       }catch(\Throwable $e)
        {
            $response=[
                "status"=>"error",
                "message"=>$e->getMessage()
            ];
        }
        return $response;
    }
    public function validatePassword($inputs)
    {
        $validator = Validator::make($inputs, [
            'oldPassword' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail('The old password is incorrect.');
                    }
                },
            ],
            'password' => 'required|min:8|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
            
            return "success";
        }
    }
    
}