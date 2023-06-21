@extends('layouts.app')
@section('content')
<div class="pt-5">
    <div class="card w-100 py-5 px-5 container shadow" style="border-radius: 20px;">
        <h3 class=" mb-2 text-bold">User Info !</h3>
        <div class="form-group row mt-3" >
          <label  class="col-sm-2 col-form-label" style="margin-top: -5px; font-size: 16px;">User Name</label>
          <div class="col-sm-10">
            <input type="text"   class="disabled  px-2 py-0.5 border border-dark" style="width:40%; border-radius: 12px; color:black;" disabled id="" value="{{$profile->username}}">
          </div>
        </div>
        <div class="form-group row" >
          <label for="brand_name" class="col-sm-2 col-form-label" style="margin-top: -5px; font-size: 16px;">Email</label>
          <div class="col-sm-10">
            <input type="text"  name=""  class="disabled px-2 py-0.5 border border-dark" style="width:40%; border-radius: 12px; color:black;" disabled id="" value="{{$profile->email}}">
          </div>
        </div>
        <div class="form-group row" >
          <label for="brand_name" class="col-sm-2 col-form-label" style="margin-top: -5px; font-size: 16px;">phone</label>
          <div class="col-sm-10">
            <input type="text"  name=""  class="disabled px-2 py-0.5 border border-dark" style="width:40%; border-radius: 12px; color:black;" disabled id="" value="{{$profile->userDetails->phone}}">
          </div>
        </div>
        <div class="form-group row" >
          <label for="brand_name" class="col-sm-2 col-form-label" style="margin-top: -5px; font-size: 16px;">Address</label>
          <div class="col-sm-10">
            <input type="text"  name=""  class="disabled px-2 py-0.5 border border-dark" style="width:40%;  border-radius: 12px; color:black;" disabled id="" value="{{$profile->userDetails->address}}">
          </div>
        </div>
        <h5 class="text-danger fw-bold">If You want to change password click the button below !</h5>  
        <div class=" d-flex w-50 ">
          <a href="{{route('client.password.index')}}" class="mx-auto btn btn-primary">Change password</a>
        </div>
        
    </div>
  </div>
@endsection