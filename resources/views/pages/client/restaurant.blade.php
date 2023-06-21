@extends('layouts.app',['key'=>$key??''])
@section('content')
@if ($res && count($res)>0)
    <h2 class="mt-5 container ps-3">Featured Restaurants</h2>
    <div class="container">
        <div class="row align-items-start">
                
            @foreach ($res as $item)
            <div class="col-md-4 mt-5">
                <a href="{{route('restaurant.index',$item->id)}}" class="text-decoration-none ">
                    <div class="card" style="width: 18rem;">
                        <div class="" style="overflow: hidden; height:100px;">
                            <img src="{{asset('storage/vendor/image_cover/'.$item->image_cover)}}" class="w-full  card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                          <h5 class="card-title">{{$item->brand_name}}</h5>
                           <p class="card-text">{{$item->service}}</p>
                        </div>                       
                    </div>
                            
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <h2 class="mt-5 container ps-3  text-center">No Items Found</h2>
    @endif
@endsection
