@extends('layouts.adminLayout')
@section('dashboard-content')
{{-- breadcumbs --}}
@php
    $data=['Dashboard'=>route('vendor.dashboard'),'Products'=>route('vendor.product.index'),'Edit Products'=>'#'];
@endphp
@include('include.admin.breadcrumbs',['datas'=>$data,])
{{-- breadcumbs  ends--}}

@include('pages.vendor.products.form',['sizes'=>$sizes,'product'=>$product])
    
@endsection