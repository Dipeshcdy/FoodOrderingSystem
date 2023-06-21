@extends('layouts.adminLayout')
@section('dashboard-content')
@php
    $data=['Dashboard'=>route('dashboard'),'Approved Vendors'=>'#'];
@endphp
@include('include.admin.breadcrumbs',['datas'=>$data,])
@php
    $sn=1;
@endphp

<!-- Main content -->
{{-- <div class="text-end">
    <a href="{{route('product_size.create')}}" class="btn btn-primary my-2 mx-2">Add Size</a>
</div> --}}
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card w-100" >
            <!-- /.card-header -->

            <div class="card-body">
                <table id="example2" class="table table-bordered table-striped table-hover w-100">
                <thead>
                <tr>
                    
                    <th>S.N.</th>
                    <th>username</th>
                    <th>email</th>
                    <th>brand name</th>
                    <th>service</th>
                    <th>logo</th>
                    <th>image cover</th>
                    <th>status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    @if (isset($approved_vendors) && count($approved_vendors) > 0)
                        @foreach ($approved_vendors as $vendor)
                        <tr>
                            
                            <td>{{$sn}}</td>
                            <td>{{Str::limit($vendor->user->username,6)}}</td>
                            <td>{{Str::limit($vendor->user->email,8)}}</td>
                            <td>{{$vendor->brand_name}}</td>
                            <td>{{$vendor->service}}</td>
                            <td>
                                <a href="{{ asset('storage/vendor/logo/'.$vendor->logo) }}"><img style="width: 50px;" src="{{ asset('storage/vendor/logo/'.$vendor->logo) }}" alt="{{$vendor->logo}}"></a>
                            </td>
                            <td>
                                <a href="{{ asset('storage/vendor/image_cover/'.$vendor->image_cover) }}"><img style="width: 50px;" src="{{ asset('storage/vendor/image_cover/'.$vendor->image_cover) }}" alt="{{$vendor->image_cover}}"></a>
                            </td>
                            <td>{{$vendor->is_active ? 'active':'inactive'}}</td>

                            <td class="d-flex">
                                @if ($vendor->is_active)
                                    
                                <a href="{{route('vendor.status',$vendor->id)}}" class="rounded-3 btn btn-warning d-inline w-50 mx-2">deactive</a>
                                @else
                                <a href="{{route('vendor.status',$vendor->id)}}" class="rounded-3 btn btn-success d-inline w-50 mx-2">active</a>
                                    
                                @endif
                                <a href="" class="rounded-3 btn btn-danger d-inline mx-2"><i class="fas fa-trash"></i></a>
                                
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
@section('custom-css')
 {{-- data table link --}}
 <link rel="stylesheet" href="{{asset('../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
 <link rel="stylesheet" href="{{asset('../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
 <link rel="stylesheet" href="{{asset('../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
{{-- data table link end --}}
    
@endsection
@section('custom-js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('../../plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('../../plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('../../plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
{{-- <script src="{{asset('../../plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('../../plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('../../plugins/pdfmake/vfs_fonts.js')}}"></script> --}}
<script src="{{asset('../../plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('../../plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('../../plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script type="text/javascript">

 

     $('.delete_btn').click(function(event) {

          var form =  $(this).closest("form");

          var name = $(this).data("name");

          event.preventDefault();

          swal({

              title: `Are you sure you want to reject ?`,

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
      

      $(function () {
      $("#example2").DataTable({
        "responsive": true,
         "lengthChange": false, 
         "autoWidth": false,
      }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
    });

  

</script>
    
@endsection