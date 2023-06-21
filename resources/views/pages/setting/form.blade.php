
<form action="{{route('vendor.profile.update',$profile->vendor->id)}}" method="POST" enctype="multipart/form-data" class="py-5">
  @csrf
  @method('PUT')  
  <div class="card w-100 py-5 px-5 container shadow" >
        <div class="form-group row mt-3" >
            <label for="brand_name" class="col-sm-2 col-form-label" style="margin-top: -5px; font-size: 16px;">Brand Name</label>
            <div class="col-sm-10">
            <input type="text" name="brand_name"  class="  px-2 py-0.5 border border-dark" style="width:40%; border-radius: 12px; color:black;" id="brand_name" value="{{$profile->vendor->brand_name}}">
            </div>
        </div>
        <div class="form-group row mt-3" >
            <label for="service" class="col-sm-2 col-form-label" style="margin-top: -5px; font-size: 16px;">Service</label>
            <div class="col-sm-10">
            <input type="text"  class="  px-2 py-0.5 border border-dark" style="width:40%; border-radius: 12px; color:black;" name="service" id="service" value="{{$profile->vendor->service}}">
            </div>
        </div>
        {{-- <div class="form-group row">
          <label for="brand_name" class="col-sm-2 col-form-label" style="margin-top: -5px;">Brand Name</label>
          <div class="col-sm-10">
            <input type="text" name="brand_name"  class="disabled px-2 py-0.5 border border-dark" style="border-radius: 12px; color:black;" disabled id="brand_name" value="{{$profile->vendor->brand_name}}">
          </div>
        </div>
        <div class="form-group row">
          <label for="service" class="col-sm-2 col-form-label">Service</label>
          <div class="col-sm-10">
            <input type="text" class="" name="service" id="service" value="{{$profile->vendor->service}}">
          </div>
        </div> --}}
        <div class="form-group">
            <label for="old_image">Current Logo</label>
            <div>
                <img width="200px" max-height="400px" src="{{asset('storage/vendor/logo/'.$profile->vendor->logo)}}" alt="{{$profile->vendor->logo}}">
            </div>
        </div>
        <div class="form-group">
    
            <div class="input-group">
                <div class="custom-file">
                    <input name="logo" type="file"  class="custom-file-input " id="select_logo">
                    <label class="custom-file-label"  for="slider_" >Choose new logo</label>
                </div>
            </div>        
        </div>
        <div class="form-group">
            <label for="old_image">Current Image Cover</label>
            <div>
                <img width="200px" max-height="400px" src="{{asset('storage/vendor/image_cover/'.$profile->vendor->image_cover)}}" alt="{{$profile->vendor->image_cover}}">
            </div>
        </div>
        <div class="form-group">
    
            <div class="input-group">
                <div class="custom-file">
                    <input name="image_cover" type="file" class="custom-file-input" id="select_image_cover"  >
                    <label class="custom-file-label" for="slider_">Choose new Image Cover</label>
                </div>
            </div>        
        </div>
    
        <div class="mx-auto mt-4">
            <button type="submit" class=" btn btn-lg btn-primary rounded-4" >
                save
            </button>
        </div>

    </div>

    {{-- <div class="form-group row">
      <label for="inputPassword" class="col-sm-2 col-form-label"></label>
      <div class="col-sm-10">
        <input type="password" class="form-control" id="inputPassword" placeholder="Password">
      </div>
    </div> --}}
    
  
{{-- <div class="card w-100 py-5 px-5 container shadow">
    <label for="brand_name" class="border bg-white w-75 px-2 py-2" style="font-size: 16px;color: rgb(151, 147, 147);border-radius: 30px;">
        Brand Name : 
        <input type="text" name="brand_name" id="brand_name" value="{{$profile->vendor->brand_name}}" style="color: rgb(79, 76, 76);font-size: 16px;font-weight: bold;outline: none;border-radius: 30px;width: 70%;" class="border px-2 py-2 ">
    </label>
    
    <label for="service" class="border bg-white w-75 px-2 py-2" style="font-size: 16px;color: rgb(151, 147, 147);border-radius: 30px;">
        Service : 
        <input type="text" name="service" id="service" value="{{$profile->vendor->service}}" style="color: rgb(79, 76, 76);font-size: 16px;font-weight: bold;outline: none;border-radius: 30px;width: 70%;" class="border px-2 py-2 ">
    </label>
    
    <label for="logo" class="border bg-white w-75 px-2 py-2" style="font-size: 16px;color: rgb(151, 147, 147);border-radius: 30px;">
        Logo : 
        <input type="file" name="logo" id="logo" value="{{$profile->vendor->logo}}" style="color: rgb(79, 76, 76);font-size: 16px;font-weight: bold;outline: none;border-radius: 30px;width: 70%;" class="border px-2 py-2 ">
    </label>
    <div class="my-2">
        <img src="{{asset('storage/vendor/logo/'.$profile->vendor->logo)}}" alt="">
    </div>
    
    <label for="image_cover" class="border bg-white w-75 px-2 py-2" style="font-size: 16px;color: rgb(151, 147, 147);border-radius: 30px;">
        Image Cover : 
        <input type="file" name="image_cover" id="image_cover" value="{{$profile->vendor->image_cover}}" style="color: rgb(79, 76, 76);font-size: 16px;font-weight: bold;outline: none;border-radius: 30px;width: 70%;" class="border px-2 py-2 ">
    </label>
    <div class="my-2">
        <img src="{{asset('storage/vendor/image_cover/'.$profile->vendor->image_cover)}}" alt="" class="w-25 h-25">
    </div>
</div> --}}

</form>