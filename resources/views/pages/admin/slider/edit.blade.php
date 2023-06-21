@extends('layouts.adminLayout')
@section('dashboard-content')
{{-- breadcumbs --}}
@php
    $data=['Dashboard'=>route('dashboard'),'Slider'=>route('slider.index'),'Edit Slider'=>'#'];
    @endphp
@include('include.admin.breadcrumbs',['datas'=>$data,])
{{-- breadcumbs  ends--}}
 <!-- general form elements -->
    <div>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Slider</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{route('slider.update',$slider->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
        
                
                <div class="card-body">
        
                    <div class="form-group">
                        <label for="slider_text">Slider Text</label>
                        <input value="{{$slider->slider_text}}" name="slider_text" type="text" class="form-control" id="slider_text" placeholder="Enter slider text">
                      </div>
                    <div class="form-group">
                    
                        <label for="slider_">Select Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="slider_image" type="file" class="custom-file-input" id="slider_">
                                <label class="custom-file-label" for="slider_">Choose file</label>
                            </div>
                        </div>        
                    </div>
                    <div class="form-group">
                        <label for="old_image">Current Image</label>
                        <div>
                            <img width="200px" max-height="400px" src="{{asset('storage/slider/'.$slider->slider_image)}}" alt="{{$slider->slider_image}}">
                        </div>
                    </div>
                        
                </div>
                   
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
    

  @endsection