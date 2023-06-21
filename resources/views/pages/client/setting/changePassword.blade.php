@extends('layouts.app')
@section('content')
<div class="pt-5">
    <div class="card d-flex w-100 py-5 px-5 container shadow" style="border-radius: 20px;">
        
        <div class="w-50 mx-auto">
            <form action="{{route('password.change',$profile->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group pw-group ">
                    <input name="oldPassword" id="oldPass" class="form-control pw-form-control" type="Password">
                    <label  for="oldPass">
                        Old Password
                    </label>
                    @error('oldPassword')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group pw-group my-4">
                    <input name="password" id="newPass" class="form-control pw-form-control" type="Password">
                    <label for="newPass">
                        New Password
                    </label>
                    @error('password')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group pw-group ">
                    <input name="password_confirmation"  id="rePass" class="form-control pw-form-control" type="Password">
                    <label for="rePass">
                        Repeat Password
                    </label>
                    @error('password_confirmation')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="d-flex mt-4">
                    <div class="mx-auto">
                        
                        <button id="changePasswordButton" class="btn btn-primary">Change</button>
                        
                        <a href="{{route('client.profile')}}" class="btn btn-danger mr-4">Exit</a>
                    </div>
                </div>
            </form>
        </div>
          
        
    </div>
</div>
@endsection
@section('custom-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script>
    $('#changePasswordButton').click(function(event) {

        var form =  $(this).closest("form");

        // var name = $(this).data("name");

        event.preventDefault();

        swal({

            title: `Are you sure you ?`,

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