   


<div class="col-md-10 col-md-offset-1 right-content-form-section profile-content">
    <div class="bars-section hidden-sm">
        <img src="{{asset('images/bar.png')}}">

        <ul class="list-inline tabs-sections">

			<?php $url = Request::url() ; ?>

            <li class="active"><a href="" class="not-active" data-toggle="">1</a></li>
             <?php if(preg_match('/service-area/', $url )) { ?>
            <li class="active"><a href="#tab2"  class="step-active" data-toggle="tab">2</a></li>
            <?php } else { ?>
            <li class=""><a href=""  class="not-active" data-toggle="">2</a></li>
            <?php } ?>

             
			<?php if(preg_match('/schedule/', $url )) { ?>
            <li class="active"><a href="#tab3"  class="step-active" data-toggle="tab">3</a></li>
             <?php } else { ?>
            <li class=""><a href=""  class="not-active" data-toggle="" disabled="disabled">3</a></li>
            <?php } ?>

 
            <?php if(preg_match('/detail/', $url )) { ?>
            <li class="active"><a href="#tab4" class="step-active" data-toggle="tab">4</a></li>
			 <?php } else { ?>
            <li class=""><a href="" class="not-active" data-toggle="" disabled="disabled">4</a></li>
            <?php } ?>
        </ul>
    </div>
</div>
 
<style type="text/css">
    
.not-active {
   pointer-events: none;
   cursor: default;
}

</style>