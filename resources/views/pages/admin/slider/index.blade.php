@extends('layouts.adminLayout')
@section('dashboard-content')
@php
    $sn=1;
@endphp
{{-- breadcumbs --}}
@php
    $data=['Dashboard'=>route('dashboard'),'Slider'=>'#'];
    @endphp
@include('include.admin.breadcrumbs',['datas'=>$data,])
{{-- breadcumbs  ends--}}

<!-- Main content -->
<div class="text-right">
    <a href="{{route('slider.create')}}" class="btn btn-primary rounded-circle my-2 mx-2"><i class="fa fa-plus"></i></a>
</div>
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card" >
            <div class="card-header">
              <h3 class="card-title">DataTable</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    
                    <th>S.N.</th>
                    <th>Slider image</th>
                    <th>Slider text</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    @if (isset($sliders) && count($sliders) > 0)
                        @foreach ($sliders as $slider)
                        <tr>
                            
                            <td>{{$sn}}</td>
                            <td>{{$slider->slider_text}}</td>
                            <td>
                                <img width="200px" max-height="400px" src="{{asset('storage/slider/'.$slider->slider_image)}}" alt="{{$slider->slider_image}}">
                            </td>
                            <td class="d-flex">
                                <a href="{{route('slider.edit',$slider->id)}}" class="rounded-3 btn btn-primary d-inline mx-2"><i class="fas fa-edit"></i></a>
                                <form action="{{route('slider.destroy',$slider->id)}}"  method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button id="delete_btn" class="delete_btn rounded-3 btn btn-danger d-inline" type="submit">
                                        <i class="fas fa-trash"></i>

                                    </button>
                                </form>
                            </td>
                        </tr>
                        @php
                            $sn++;
                        @endphp
                        @endforeach
                    @else
                    <tr>
                        <td rowspan="4">empty</td>
                    </tr>
                    @endif
                

                
                </tbody>

                </table>
            </div>
        </div>    
    </div>
</section>
                
@endsection
@section('custom-js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

<script type="text/javascript">

 

     $('.delete_btn').click(function(event) {

          var form =  $(this).closest("form");

          var name = $(this).data("name");

          event.preventDefault();

          swal({

              title: `Are you sure you want to delete ?`,

              //text: "If you delete this, it will be gone forever.",

              icon: "warning",

              buttons: true,

              dangerMode: true,

          })

          .then((willDelete) => {

            if (willDelete) {

              form.submit();

            }

          });

      });

  

</script>
    
@endsection