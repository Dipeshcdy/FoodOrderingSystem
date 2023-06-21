@extends('layouts.adminLayout')
@section('dashboard-content')
{{-- breadcumbs --}}
@php
    $data=['Dashboard'=>route('vendor.dashboard'),'Products'=>route('vendor.product.index'),'Add Products'=>'#'];
@endphp
@include('include.admin.breadcrumbs',['datas'=>$data,])
{{-- breadcumbs  ends--}}
@include('pages.vendor.products.form',['sizes'=>$sizes])
    
@endsection