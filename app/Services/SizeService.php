<?php

namespace App\Services;

use App\Models\Size;
use PhpParser\Node\Expr\FuncCall;

class SizeService
{
    public function findAll()
    {
        $sliders=Size::all();
        return $sliders;
    }
    public function findId($id)
    {
        $sliders=Size::find($id);
        return $sliders;
    }
    public function addSize($request)
    {
        try{
           
            $size=[
                'name'=>$request['name'],
            ];
            Size::create($size);
            $response=[
                "status"=>"success",
                "message"=>"size created successfully"
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
    public function updateSize($request,$id)
    {
        try{
            $size=[
                'name'=>$request['name'],
            ];
            
            $id=$this->findId($id);
            $id->update($size);
            $response=['status'=>'success','message'=>'size is updated'];
        }catch(\Throwable $e)
        {
           
            $response=['status'=>'error','message'=>$e->getMessage()];
        }
        
        return $response;
    }
    public function destroy($id)
    {
        try{
            $id=$this->findId($id);
            $id->delete();
            $response=['status'=>'success','message'=>'slider is deleted'];
        }catch(\Throwable $e)
        {
            $response=['status'=>'error','message'=>$e->getMessage()];
        }
        return $response;
       
    }
}