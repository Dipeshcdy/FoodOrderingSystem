@extends('layouts.app')
@section('content')
    <div style="max-height: 500px; overflow:hidden;">
       <img class="w-100"  src="{{asset('storage/vendor/image_cover/'.$vendor->image_cover)}}" alt=""> 
       
    </div>
    <div style=" margin-top:-200px; display:flex;" class="">
        <div style="margin-left:200px; ">
            <img width="200" height="200" style="max-width: 100%; height: auto;" src="{{asset('storage/vendor/logo/'.$vendor->logo)}}" alt="">
        </div>
        <div class="text-white" style=" margin-top:75px; margin-left:10px;">
            <h1 class="fs-1" style="text-transform: uppercase;">{{$vendor->brand_name}}</h1>
            <h2 class="fs-4">{{$vendor->service}}</h2>
        </div>
        
   </div>
   <div class="mt-5 container">
    <h2 class="mt-5">
        Food items
    </h2>
    @if (isset($products) && $products->count() > 0)
        
    <div>
        @foreach ($products as $product)
            
        <div class="card mt-3 container">
            <div class="card-body justify-content-between d-flex">
              <h2 class="fs-3">{{$product->name}}</h2>
              
                @guest
                <div class="justify-content-center ">
                    <h3 class="fs-5  my-auto">{{$product->price}} {{$product->size->name}}</h3>
                </div>
                @else
                 
                <div class="w-50">
                    <div class="d-flex w-100">
                       
                        <div class="d-flex my-auto w-50">
                            <label for="" class="me-4 fs-5">Quantity</label>
                            <div class="input-group">
                                <span class="input-group-btn me-1">
                                    <button type="button" onclick="incrementDecrementBtn({{$product->id}},'minus')"  class="btn rounded-circle btn-danger btn-number">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </span>
                                <input type="text" id="qty{{$product->id}}" disabled  class="form-control input-number" value="1" min="1" max="100">
                                <span class="input-group-btn ms-1">
                                    <button type="button" onclick="incrementDecrementBtn({{$product->id}},'plus')" class="btn rounded-circle btn-success btn-number">
                                        <i class="fa fa-plus" ></i>
                                    </button>
                                </span>
                            </div>
                            {{-- <input type="number" > --}}
                        </div>
                       
                        <div class="d-flex w-50 justify-content-center ">
                            <h3 class="fs-5  my-auto">{{$product->price}} {{$product->size->name}}</h3>
                        </div>
                        
                        <a onclick="addToCart({{$product->id}})" class="btn cursor-pointer text-decoration-none">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    
                        <input type="hidden" id="accessToken" value="{{Session::get('token')}}">
                       
                        
                    
                    </div>
               
                </div>
                @endguest

            </div>
        </div>    
        @endforeach
    </div>
    @endif
</div>
@endsection

@section('custom-js')
<script src="{{asset('js/Cart.js')}}"></script>
<script src="{{asset('css/Cart.css')}}"></script>
@endsection