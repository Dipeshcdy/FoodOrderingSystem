@extends('layouts.adminLayout')
@section('dashboard-content')
@php
    $data=['Dashboard'=>route('dashboard'),'Product size'=>route('product_size.index'),'Create product size'=>'#'];
@endphp
@include('include.admin.breadcrumbs',['datas'=>$data,])

 <!-- general form elements -->
    <div>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Size</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{route('product_size.store')}}" method="post" >
                @csrf
        
                
                <div class="card-body">
        
                    <div class="form-group">
                        <label for="name">Size Name</label>
                        <input name="name" type="text" class="form-control" id="name" placeholder="Enter size">
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