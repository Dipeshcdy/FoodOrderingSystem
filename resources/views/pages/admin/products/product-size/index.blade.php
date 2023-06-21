@extends('layouts.adminLayout')

@section('dashboard-content')

@php
    $data=['Dashboard'=>route('dashboard'),'Product size'=>'#'];
@endphp
@include('include.admin.breadcrumbs',['datas'=>$data,])

@php
    $sn=1;
@endphp

<!-- Main content -->
<div class="text-right mr-4">
    <a href="{{route('product_size.create')}}" class="btn btn-primary my-2 mx-2">Add Size</a>
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
                    <th>Product Size</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    @if (isset($product_sizes) && count($product_sizes) > 0)
                        @foreach ($product_sizes as $product_size)
                        <tr>
                            
                            <td>{{$sn}}</td>
                            <td>{{$product_size->name}}</td>

                            <td class="d-flex">
                                <a href="{{route('product_size.edit',$product_size->id)}}" class="rounded-3 btn btn-primary d-inline mx-2"><i class="fas fa-edit"></i></a>
                                <form action="{{route('product_size.destroy',$product_size->id)}}"  method="POST">
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
    