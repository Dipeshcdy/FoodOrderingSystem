
@if (isset($product))
<div>
    <div class="card card-primary">
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('vendor.product.update',$product->id)}}" method="post" >
            @csrf
            @method('PUT')
    
            
            <div class="card-body">
    
                <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Name" value="{{$product->name}}">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input name="price" type="text" class="form-control" id="name" placeholder="Price" value="{{$product->price}}">
                </div>
                <div class="form-group">
                    <select name="status" class="form-select" aria-label="Default select example">
                        <option {{$product->status==='Available'?'selected':''}} value="Available">Available</option>
                        <option {{$product->status==='Not available'?'selected':''}} value="Not available">Not available</option>
                        <option {{$product->status==='Out of stock'?'selected':''}} value="Out of stock">Out of stock</option>
                    </select>
                </div>
                <div class="form-group">
                    <select name="size" class="form-select" aria-label="Default select example">
                            {{-- <option selected>select size</option> --}}
                        @foreach ($sizes as $size)
                        
                            <option {{$product->size_id===$size->id?'selected':''}}  value="{{$size->id}}">{{$size->name}}</option>
                        @endforeach
                    </select>
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
    
@else
<div>
    <div class="card card-primary">

        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('vendor.product.store')}}" method="post" >
            @csrf
    
            
            <div class="card-body">
    
                <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input name="price" type="text" class="form-control" id="name" placeholder="Price">
                </div>
                <div class="form-group">
                    <select name="status" class="form-select" aria-label="Default select example">
                        <option value="Available">Available</option>
                        <option value="Not available">Not available</option>
                        <option value="Out of stock">Out of stock</option>
                    </select>
                </div>
                <div class="form-group">
                    <select name="size" class="form-select" aria-label="Default select example">
                            {{-- <option selected>select size</option> --}}
                        @foreach ($sizes as $size)
                        
                            <option value="{{$size->id}}">{{$size->name}}</option>
                        @endforeach
                    </select>
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
@endif