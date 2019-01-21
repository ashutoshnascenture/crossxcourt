@extends('admin')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h2><?php echo $page->title;?></h2>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="inner-content">
      <p><strong></strong></p>
      
<!--
      <p><strong><?php //echo $page->slug;?></strong></p>
-->
      
      <section>
      	<div>
      		<?php echo $page->content;?>
      	</div>
      </section>
       </div><!-- content section ends -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
    
@endsection
