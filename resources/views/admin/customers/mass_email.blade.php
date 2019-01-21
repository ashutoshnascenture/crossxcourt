@extends('admin')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2>Send promotions emails to registered customers or coach</h2>
        <p class="pull-right">
            <!--<a href="coaches/create" class="btn btn-success">Add New</a>-->
        </p>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="inner-content">

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

            <form class="form-horizontal" role="form" method="POST" action="{{URL::to('admin/customers/send-email')}}">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 
				<div class="form-group">
                    <label class="col-md-3 control-label">To</label>
                    <div class="col-md-8">
                        <label class="radio-inline">
						  <input type="radio" name="to" id="customer" value="3"> Customers
						</label>
						<label class="radio-inline">
						  <input type="radio" name="to" id="coaches" value="2"> Coaches
						</label>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-3 control-label">Subject</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="subject" value="{{ old('subject') }}">
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-3 control-label">Message</label>
                    <div class="col-md-8">
                       <textarea name="message" class="form-control" rows="10" value="{{ old('message') }}"></textarea>
                    </div>
                </div>
				
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <button type="submit" class="btn btn-primary update">
                            Send
                        </button>
                        
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

@endsection
