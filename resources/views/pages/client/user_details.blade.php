@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row ">
            <div class="col-5">
                <div>
                    <h2 class="container">User Details</h2>
                    <div class="card p-4">
                        <form action="{{route('user.detail.add')}}" method="POST">
                            @csrf
                            <label for="address" class="ms-2 fs-3">Address</label><br>
                            <input  value="{{old('address')}}" class="w-100 mt-2 rounded" id="address" type="text" name="address" >
                            @error('address')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                            <label for="phone" class="ms-2 mt-4 fs-3">Phone</label><br>
                            <input  value="{{old('phone')}}" class="w-100 mt-2 rounded" id="phone" type="text" name="phone" >
                            @error('phone')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                            <div class="d-flex">
                            <button type="submit" class="mx-auto mt-4 btn btn-primary">Add</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col mt-3">
                <div class="card-body rounded mt-4">
                    <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        
                        <th>SN</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                                
                        @if (isset($userDetails) && count($userDetails) > 0)
                                @php
                                    $sn=1;
                                @endphp
                            @foreach ($userDetails as $detail)
                            <tr>
                                
                                <td>{{$sn}}</td>
                                <td>{{$detail->address}}</td>
                                <td>{{$detail->phone}}</td>
                                <td class="d-flex">
                                  <a  class="mx-2"><i class="fas fa-edit text-primary"  data-toggle="modal" data-target="#editModal"  style="cursor: pointer;" onclick="EditModal({{$detail->id}},'{{$detail->address}}',{{$detail->phone}})"></i></a>
                                  <form action="{{route('user.detail.delete',$detail->id)}}" method="POST" >
                                    @csrf
                                    @method('DELETE')
                                    <a  class="delete_btn mx-2 "><i style="cursor: pointer;" class=" text-danger fas fa-trash"></i></a>
                                  </form> 
                                </td>
                                @php
                                    $sn++;
                                @endphp
                            </tr>
                            @endforeach
                        @else
                        <tr>
                            <td rowspan="4">empty</td>
                        </tr>
                        @endif
                    
    
                    
                    </tbody>
    
                    </table>
                    {{-- <input type="hidden" id="accessToken" value="{{Session::get('token')}}"> --}}
                </div>
            </div>
        </div>
    </div>



    {{-- modal for edit --}}

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">User Details</h5>
              <a data-bs-dismiss="modal" data-toggle="modal" data-target="#editModal"><i class="fa fa-times text-danger" style="cursor: pointer;" aria-hidden="true"></i></a>
            </div>
            <form action="{{route('user.detail.update')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="card p-4">
                            <label for="modalAddress" class="ms-2 fs-3">Address</label><br>
                            <input required  class="w-100 mt-2 rounded" id="modalAddress" type="text" name="address" >
                            <label for="modalPhone" class="ms-2 mt-4 fs-3">Phone</label><br>
                            <input required  class="w-100 mt-2 rounded" id="modalPhone" type="text" name="phone" >
                            <input type="hidden" id="modalUserDetailId" name="id">
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#editModal" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
             </form>
          </div>
        </div>
      </div>
    {{-- modal for edit ends --}}
@endsection

@section('custom-js')
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
{{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.delete_btn').click(function(event) {
        console.log('hello');
        var form =  $(this).closest("form");

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
});

function EditModal(id,address,phone)
{
    console.log(id);
    console.log(address);
    console.log(phone);
    document.getElementById('modalUserDetailId').value=id;
    document.getElementById('modalAddress').value=address;
    document.getElementById('modalPhone').value=phone;
}


</script>

@endsection