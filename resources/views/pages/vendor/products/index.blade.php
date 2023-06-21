@extends('layouts.adminLayout')
@section('dashboard-content')
{{-- breadcumbs --}}
@php
    $data=['Dashboard'=>route('vendor.dashboard'),'Products'=>'#'];
    @endphp
@include('include.admin.breadcrumbs',['datas'=>$data,])
{{-- breadcumbs  ends--}}
@php
    $sn=1;
@endphp

<!-- Main content -->
<div class="text-right mr-4">
    <a href="{{route('vendor.product.create')}}" class="btn btn-primary rounded-circle my-2 mx-2"><i class="fa fa-plus"></i></a>
</div>
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card" >
            <!-- /.card-header -->

            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    
                    <th>S.N.</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>status</th>
                    <th>size</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    @if (isset($products) && count($products) > 0)
                        @foreach ($products as $product)
                        <tr>
                            
                            <td>{{$sn}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->status}}</td>
                            <td>{{$product->size->name}}</td>

                            <td class="d-flex">
                                <a href="{{route('vendor.product.edit',$product->id)}}" class="rounded-3 btn btn-primary d-inline mx-2"><i class="fas fa-edit"></i></a>
                                <form action="{{route('vendor.product.delete',$product->id)}}"  method="POST">
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
      

      $(function () {
      $("#example2").DataTable({
        "responsive": true,
         "lengthChange": false, 
         "autoWidth": false,
      }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
    });

  

</script>
    
@endsection