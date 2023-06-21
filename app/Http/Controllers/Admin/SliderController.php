<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Services\SliderService;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    private $slider_service;
    public function __construct(SliderService $service)
    {
        $this->slider_service=$service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders=$this->slider_service->findAll();
        return view('pages.admin.slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.slider.create');
    }
        
    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {

        // dd('hi');
       // $sliders=$this->slider_service->findAll();
        $response=$this->slider_service->addSlider($request);
        if($response['status']=='success')
        {
            
            Alert::success($response['status'], $response['message']);
        }
        else
        {
            Alert::error($response['status'], $response['message']);
            
        }
       // dd($response);
        return redirect('slider');
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
        $slider=$this->slider_service->findId($id);
        //dd($slider);
        return view('pages.admin.slider.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderRequest $request, string $id)
    {
        $response=$this->slider_service->updateSlider($request,$id);
        if($response['status']=='success')
        {
            
            Alert::success($response['status'], $response['message']);
        }
        else
        {
            Alert::error($response['status'], $response['message']);
            
        }
        //dd($response);
        return redirect('slider');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response=$this->slider_service->destroy($id);
        if($response['status']=='success')
        {
            
            Alert::success($response['status'], $response['message']);
        }
        else
        {
            Alert::error($response['status'], $response['message']);
            
        }
        //dd($slider);
        return redirect(route('slider.index'));
    }
}