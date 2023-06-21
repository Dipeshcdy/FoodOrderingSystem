<?php

namespace App\Services;

use App\Models\Slider;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\FuncCall;

class SliderService
{
    public function findAll()
    {
        $sliders=Slider::all();
        return $sliders;
    }
    public function findId($id)
    {
        $sliders=Slider::find($id);
        return $sliders;
    }
    public function addSlider($request)
    {
        try{
            if($request->hasFile('slider_image'))
            {
                $file_name_with_extension=$request['slider_image']->getClientOriginalName();
                $file_name=pathinfo($file_name_with_extension, PATHINFO_FILENAME);
                $extension=$request['slider_image']->getClientOriginalExtension();
                $file_to_store=$file_name.'_'.time().'_'.$extension;
                $path=$request['slider_image']->storeAs('public/slider/'.$file_to_store);
            }
            else{
                $file_to_store='no_image.jpg';
            }
            $slider=[
                'slider_text'=>$request['slider_text'],
                'slider_image'=>$file_to_store,
            ];
            Slider::create($slider);
            $response=[
                "status"=>"success",
                "message"=>"slider created successfully"
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
    public function updateSlider($request,$id)
    {
        try{
            $slider=$this->findId($id);
            
            if($request->hasFile('slider_image'))
            {
                $file_name_with_extension=$request['slider_image']->getClientOriginalName();
                $file_name=pathinfo($file_name_with_extension, PATHINFO_FILENAME);
                $extension=$request['slider_image']->getClientOriginalExtension();
                $file_to_store=$file_name.'_'.time().'_'.$extension;
                $path=$request['slider_image']->storeAs('public/slider/'.$file_to_store);
                $data=[
                    'slider_text'=>$request['slider_text'],
                    'slider_image'=>$file_to_store,
                ];
                Storage::delete('public/slider/'.$slider->slider_image);
            }
            else{
                $data=[
                    'slider_text'=>$request['slider_text'],
                ];
            }
            
            $slider->update($data);
            $response=['status'=>'success','message'=>'slider is updated'];
        }catch(\Throwable $e)
        {
           
            $response=['status'=>'error','message'=>$e->getMessage()];
        }
        
        return $response;
    }
    public function destroy($id)
    {
        try{
            $slider=$this->findId($id);
            Storage::delete('public/slider/'.$slider->slider_image);
            $slider->delete();
            $response=['status'=>'success','message'=>'slider is deleted'];
        }catch(\Throwable $e)
        {
            $response=['status'=>'error','message'=>$e->getMessage()];
        }
        return $response;
       
    }
}