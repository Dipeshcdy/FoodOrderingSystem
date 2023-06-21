@extends('layouts.adminLayout')
@section('dashboard-content')
{{-- bread cumbs --}}
@php
   if ($profile->role->role === "admin")
   {

     $data=['Dashboard'=>route('dashboard'),'Profile settings'=>'#'];
   }
   elseif ($profile->role->role === "vendor")
   {

     $data=['Dashboard'=>route('vendor.dashboard'),'Profile settings'=>'#'];
   }
   
   
@endphp
@include('include.admin.breadcrumbs',['datas'=>$data,])

{{-- bread cumbs end --}}


<div class="pt-5">
  <div class="card w-100 py-5 px-5 container shadow" >
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
      @if ($profile->role->role === "vendor")
        <div class="form-group row" >
          <label for="brand_name" class="col-sm-2 col-form-label" style="margin-top: -5px; font-size: 16px;">Status</label>
          <div class="col-sm-10">
            <input type="text"  name=""  class="disabled px-2 py-0.5 border border-dark" style="width:40%; border-radius: 12px; color:black;" disabled id="" value="{{$profile->vendor->is_active == 1 ? 'Active':'Inactive'}}">
          </div>
        </div>
      @endif
      <h5 class="text-danger fw-bold">If You want to change password click the button below !</h5>  
      <div class=" d-flex w-50 ">
        <a href="{{$profile->role->role === "admin"?route('admin.password.index'):route('vendor.password.index')}}" class="mx-auto btn btn-primary">Change password</a>
      </div>
      {{-- <div>
        <label for="" class="border bg-white w-50 px-2 py-2" style="font-size: 16px;color: rgb(151, 147, 147);border-radius: 30px;">
          User Name : 
          <input type="text" value="{{$profile->username}}" style="color: rgb(79, 76, 76);font-size: 16px;font-weight: bold;" class="disabled border-0" disabled>
        </label>
      </div>
      <div>
        <label for="" class="border bg-white w-50 px-2 py-2" style="font-size: 16px;color: rgb(151, 147, 147);border-radius: 30px;">
          Email : 
          <input type="text" value="{{$profile->email}}" style="color: rgb(79, 76, 76);font-size: 16px;font-weight: bold;" class="disabled border-0" disabled>
        </label>
      </div>
      <div>
        <label for="" class="border bg-white w-50 px-2 py-2" style="font-size: 16px;color: rgb(151, 147, 147);border-radius: 30px;">
          Role : 
          <input type="text" value="{{$profile->role->role}}" style="color: rgb(79, 76, 76);font-size: 16px;font-weight: bold;" class="disabled border-0" disabled>
        </label>
      </div>
      <div>
        <label for="" class="border bg-white w-50 px-2 py-2" style="font-size: 16px;color: rgb(151, 147, 147);border-radius: 30px;">
          Phone : 
          <input type="text" value="{{$profile->userDetails->phone}}" style="color: rgb(79, 76, 76);font-size: 16px;font-weight: bold;" class="disabled border-0" disabled>
        </label>
      </div>
      <div>
        <label for="" class="border bg-white w-50 px-2 py-2" style="font-size: 16px;color: rgb(151, 147, 147);border-radius: 30px;">
          Address : 
          <input type="text" value="{{$profile->userDetails->address}}" style="color: rgb(79, 76, 76);font-size: 16px;font-weight: bold;" class="disabled border-0" disabled>
        </label>
      </div>
      @if ($profile->role->role === "vendor")
      <div>
        <label for="" class="border bg-white w-50 px-2 py-2" style="font-size: 16px;color: rgb(151, 147, 147);border-radius: 30px;">
          Stautus : 
          <input type="text" value="{{$profile->vendor->is_active == 1 ? 'Active':'Inactive'}}" style="color: rgb(79, 76, 76);font-size: 16px;font-weight: bold;" class="disabled border-0" disabled>
        </label>
      </div>
      @endif --}}
  </div>
</div>

@if ($profile->role->role === "vendor" && $profile->vendor->is_active == 1)
@include('pages.setting.form',['profile'=>$profile])
@endif
@endsection
