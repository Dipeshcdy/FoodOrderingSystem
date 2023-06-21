
@if ($msg = Session::get('success'))
    <div class="alert alert-success">
        <strong class="text-primary ml-5">
            {{$msg}}

         
        </strong>
    </div>
@endif


@if ($msg = Session::get('error'))
    <div class="alert alert-danger">
        <strong class="text-primary ml-5">
            {{$msg}}

         
        </strong>
    </div>
@endif
{{-- @if ($msg = session::has('error'))
    <div>
        <strong>
            {{$msg}}
        </strong>
    </div>
@endif

@if ($msg = session::has('warning'))
    <div>
        <strong>
            {{$msg}}
        </strong>
    </div>
@endif --}}

