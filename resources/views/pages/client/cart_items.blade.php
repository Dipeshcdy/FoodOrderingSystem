@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Cart Items</h2>
   
</div>
<div class="container d-flex">
   <div class="w-75 rounded-4 p-4 shadow">
        <table class="table table-bordered">
            <thead>
                <th>SN</th>
                <th>Mame</th>
                <th>Rate</th>
                <th>Quantity</th>
                <th>Price</th>
            </thead>
            <tbody>
                @php
                    $sn=1;
                    $totalPrice=0;
                @endphp
                @if (!empty($cartItems) && count($cartItems) > 0)
                    @foreach ($cartItems as $item)
                        <tr>
                            <td>{{$sn}}</td>
                            <td>{{$item->product->name}}</td>
                            <td>Rs {{$item->product->price}}</td>
                            <td class="w-25">
                                <div class="input-group">
                                    <span class="input-group-btn me-1">
                                        <button type="button" onclick="cartItemQtyUpdate({{$item->id}},'minus')"  class="btn rounded-circle btn-danger btn-number">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </span>
                                    <input type="text" id="qty{{$item->id}}" disabled  class="form-control input-number" value="{{$item->quantity}}" min="1" max="100">
                                    <span class="input-group-btn ms-1">
                                        <button type="button" onclick="cartItemQtyUpdate({{$item->id}},'plus')" class="btn rounded-circle btn-success btn-number">
                                            <i class="fa fa-plus" ></i>
                                        </button>
                                    </span>
                                </div>
                                 
                            </td>
                            <td  id="price{{$item->id}}">Rs {{$item->quantity*$item->product->price}}</td>
                        </tr>
                        @php
                            $sn++;
                            $totalPrice=$totalPrice+$item->quantity*$item->product->price;
                        @endphp
                    @endforeach
                    <tr>
                        <td colspan="4" style="text-align: center;">Total</td>
                        <td id="totalPrice">Rs {{$totalPrice}}</td>
                    </tr>
                    <input type="hidden" id="accessToken" value="{{Session::get('token')}}">
                @else
                    <tr>
                        <td class="text-center fs-3 fw-bold text-danger" colspan="3"> No Any carts found</td>
                    </tr>
                @endif
                
            </tbody>
        </table>
   </div>
   <div class=" ms-4">
        <div class="container mx-auto rounded-4 shadow p-5">
            <form action="{{route('cart.checked_out')}}" method="POST">
                @csrf
                @if (count($cartItems)>0)
                
                <input name="cart_id" type="hidden" value="{{$cartItems[0]->cart_id}}">
                @endif
                {{-- <input type="text" name="shipping_address" class="w-100 rounded-3 outline-none"> --}}
                <div class="form-group pw-group my-4">
                    <input name="shipping_address" required id="address" class="form-control pw-form-control" type="text">
                    <label for="address">
                        Shipping Address
                    </label>
                </div>
                <div class="d-flex mt-3">
                    <button type="submit" class="btn {{count($cartItems)<1?'disabled':''}}  mx-auto btn-danger w-full ">Checkout</button>
                    
                </div>    
            </form>
        </div>
   </div>
</div>
    
@endsection
@section('custom-css')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
@endsection
@section('custom-js')
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

<script src="{{asset('js/Cart.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>
@endsection