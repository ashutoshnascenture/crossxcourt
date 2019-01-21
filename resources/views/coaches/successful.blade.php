@extends('app')
@section('title','Home')
@section('content')
<div class="container-fluid">
    <div class="row">
         <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
    <!--                <div class="alert alert-success">

                        <strong>Success!</strong> Successfully login.
-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
