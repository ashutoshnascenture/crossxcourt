@extends('app')
@section('content')
 
<section class="middle-section-search padding-top-bottom-5">
	<div id="section-top-container">
		<div class="container">
		 
		 
			<h2 class="search-title"><?php echo $page->title; ?></h2>
			<hr class="main">	
			 
			<?php  echo $page->content; ?>
		
		</div><!-- section top container ends -->
		</div>
    </section> 
 
   

@endsection