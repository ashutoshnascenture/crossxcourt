  
@extends('app')
@section('content')

<div class="container-fluid">
    <div class="row">
        @include('includes.sidebar')

        <div class="col-md-9 col-sm-12 col-xs-12 right-content-form-section pull-right profile-content">
             
                 <h2>Thank your review</h2> 
                 <hr>
                <div class="col-md-9 form-container">
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
                        @else
                        <div class="alert alert-success">
                            <strong>Success</strong> Review has been added successfully.<br><br>
                        </div>
                        @endif
                        
                        <a href="{{LaravelLocalization::localizeURL('coaches/profile')}}/{{$users->first_name}}-{{$users->last_name}}/{{$users->id}}" class="btn btn-success">Book lesson</a>
                        <a href="{{ LaravelLocalization::localizeURL('customer/') }}" class="btn btn-primary">back to lesson</a>

						<!-- <a href="{{ url('add_message/') }}" class="btn btn-primary create-lesson"> Send Message </a> -->
                    </div>
                </div>
            
        </div>
    </div>
</div>
@include('includes.footer')
<style>
.thankyou-review{background-color: #dff0d8;
    border-color: #d6e9c6;
    color: #3c763d;
    margin: 38px 0;
    padding: 20px 0 0 20px;}
</style>
@endsection


