@extends('app') 
@section('content')

<link href="{{ asset('/css/404.css') }}" rel="stylesheet">
	
<div class="wrapper row2">
  <div id="container" class="clear">
    
    <section id="fof" class="clear">
      
      <div class="fl_left"><img src="{{asset('images/404.png')}}" alt=""></div>
      <div class="fl_right">
        <h1>SORRY!</h1>
        <p>The Page You Requested Could Not Be Found On Our Server</p>
        <p>Go back to the <a href="javascript:history.go(-1)">Previous page</a> or visit our <a href="{{URL::to('/')}}">Homepage</a></p>
        
      </div>
      
    </section>
    
  </div>
</div>
@endsection