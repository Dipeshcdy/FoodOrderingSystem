@php
    $last_key = array_key_last($datas);

@endphp
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">{{$last_key}}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                @foreach ($datas as $key=>$value)
                    <li class="breadcrumb-item {{$last_key == $key?'active':''}}">
                        <a href="{{$value}}">{{$key}}</a>
                    </li>
                @endforeach
            </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>