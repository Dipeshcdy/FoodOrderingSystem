<div class=" w-100">
    <div id="carouselExampleCaptions" class="carousel slide " data-bs-ride="carousel">
     
        <div class="carousel-indicators">
          @if (isset($sliders) && count($sliders) > 0)
            @foreach ($sliders as $key=>$slider)
                
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$key}}" class="active" aria-current="{{$key==0?true:false}}" aria-label="Slide 1"></button>
                
            @endforeach
          @endif

        </div>
        <div class="carousel-inner">
          @if (isset($sliders) && count($sliders) > 0)
            @foreach ($sliders as $key=>$slider)
                <div class="carousel-item {{$key==0?'active':''}}">
                  <img src="{{asset('storage/slider/'.$slider->slider_image)}}" class="d-block w-100 " alt="...">
                  <div class="carousel-caption d-none d-md-block mb-5 bg-white text-primary fw-bold">
                    <h5 class="mb-0">{{$slider->slider_text}}</h5>
                    
                  </div>
                </div>
                
            @endforeach
          @endif
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
</div>