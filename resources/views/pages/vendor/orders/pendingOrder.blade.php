@extends('layouts.adminLayout')
@section('dashboard-content')
{{-- breadcumb --}}
@php
    $data=['Dashboard'=>route('vendor.dashboard'),'Pending Orders'=>'#'];
    $sn=1;
@endphp
@include('include.admin.breadcrumbs',['datas'=>$data,])

{{-- breadcumb ends --}}
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
                    <th>SN</th>
                    <th>Order ID</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    @if (isset($pendingOrder) && count($pendingOrder) > 0)
                        @foreach ($pendingOrder as $order)
                        <tr>
                            <td>{{$sn}}</td>
                            <td>{{$order->order_id}}</td>
                            <td>{{$order->status}}</td>
                            <td>{{$order->updated_at}}</td>
                            <td class="d-flex">
                              <button onclick="vendorPendingItemView({{$order->id}})" class="rounded-3 btn d-inline mx-2"  data-toggle="modal"  data-target="#exampleModal"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                
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
                <input type="hidden" id="accessToken" value="{{Session::get('token')}}">
            </div>

            <!-- Button trigger modal -->




<!-- Modal -->
{{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Order Items</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="overflow-auto">
          <h2 class="border-bottom border-secondary border-4 pb-2" style="font-size:20px; ">vendor title</h2>
          <table id="example2" class="table table-bordered table-hover">
            <thead>
            <tr>
                
                <th>Product</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody>
              <tr>
                            
                <td>momo</td>
                <td>100</td>
                
              </tr>
            </tbody>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> --}}

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Order Items</h5>
        <a type="button" class="btn-close" data-bs-dismiss="modal" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-times text-danger" aria-hidden="true"></i>        </a>
      </div>
      <div class="modal-body" id="modalBody">
       
      </div>
      <div class="modal-footer">
        {{-- <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> --}}
      </div>
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
<script src="{{asset('js/pendingItemView.js')}}"></script>

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
      

      $(function () {
      $("#example2").DataTable({
        "responsive": true,
         "lengthChange": false, 
         "autoWidth": false,
      }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
    });

  

</script>
    
@endsection