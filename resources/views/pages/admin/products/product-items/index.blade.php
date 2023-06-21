@extends('layouts.adminLayout')
@section('dashboard-content')
    
@php
$data=['Dashboard'=>route('dashboard'),'Product Items'=>'#'];
@endphp
@include('include.admin.breadcrumbs',['datas'=>$data,])


<!-- Main content -->

<section class="content">
    @if (isset($vendorProducts) && count($vendorProducts) > 0)
        @foreach ($vendorProducts as $key=>$products)
        @php
        $sn=1;
        @endphp

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card" >
                            <div class="card-header">
                                <h3 class="card-title">{{$key}}</h3>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">
                                    
                                    <table id="" class="example2 table table-bordered table-hover w-100">
                                        <thead>
                                            <tr>
                                                
                                                <th>S.N.</th>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @php
                                                die($products);
                                            @endphp --}}
                                            @if (isset($products) && count($products) > 0)
                                                @foreach ($products as $key=>$product)
                                                <tr>
                                                    
                                                    <td>{{$sn}}</td>
                                                    <td>{{$product['name']}}</td>
                                                    <td>{{$product['price']}}</td>

                                                    {{-- <td class="d-flex">
                                                        <a href="{{route('product_size.edit',$product_size->id)}}" class="rounded-3 btn btn-primary d-inline mx-2"><i class="fas fa-edit"></i></a>
                                                        <form action="{{route('product_size.destroy',$product_size->id)}}"  method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button id="delete_btn" class="delete_btn rounded-3 btn btn-danger d-inline" type="submit">
                                                                <i class="fas fa-trash"></i>

                                                            </button>
                                                        </form>
                                                    </td> --}}
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
                </div>
            </div>    
        @endforeach
    @endif
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

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script> --}}
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

 

    //  $('.delete_btn').click(function(event) {

    //       var form =  $(this).closest("form");

    //       var name = $(this).data("name");

    //       event.preventDefault();

    //       swal({

    //           title: `Are you sure you want to delete ?`,

    //           //text: "If you delete this, it will be gone forever.",

    //           icon: "warning",

    //           buttons: true,

    //           dangerMode: true,

    //       })

    //       .then((willDelete) => {

    //         if (willDelete) {

    //           form.submit();

    //         }

    //       });

    //   });

      $(function () {
      $(".example2").DataTable({
        "responsive": true,
         "lengthChange": false, 
         "autoWidth": false,
      }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
    });

  

</script>
    
@endsection