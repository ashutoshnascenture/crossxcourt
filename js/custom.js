$(function(){
	
	//bind stats list 
	$('#country_list').change(function(){
		 
		$.get(siteUrl+"/states/" + $(this).val(), function( data ) { 
			var data = $.parseJSON(data);
			var states = '<option value="">-- select state --</option>';
			if(data.length > 0){
				for(i in data){
					states+= '<option>'+data[i].name+'</option>';
				}
			}
			$('#state_list').html(states);
		});
	});
	
	//add new court
	$('#addcourt').submit(function(){
			
		$.ajax({
			url : siteUrl+"/coaches/add-court",
			type : 'post',
			data : $('#addcourt').serialize(),
			dataType:'json',
			
			success : function(res){
				console.log(res);
				if(res['type'] == 'success'){
				var option = '<option value="'+res['id']+'">'+res['name']+'<option>';
					$('#courtList').append(option).val(res['id']);
					$('#myCourts').modal('hide');
					$('#addcourt')[0].reset();
				}
				else{
					var errors = res['errors'];
					var text = '';
					for(i in errors){
						text += errors[i][0] + '\n';
					}
					alert(text);
				}
			}
			
		});
		
		return false;
	});
	
	 
	$('.teaching-level input, .teach-age-player input').click(function(){
		
		var val = $(this).val().trim();
		if(val == 'All_level' || val == 'All_ages'){
			var selector = 	(val == 'All_level') ? '.teaching-level input' : '.teach-age-player input';  
			$(selector+":checkbox").prop('checked', $(this).prop("checked"));
		}
		else{
			$(this).parents('.label-text-area').find('input').last().attr('checked', false);
			 
		}
		 
	});
	
	$('#addcourts').submit(function(){
			
		$.ajax({
			url : siteUrl+"/coaches/store-court",
			type : 'post',
			data : $('#addcourts').serialize(),
			dataType:'json',
			
			success : function(res){
				 
				if(res['type'] == 'success'){
					 
					var text = "<a><br/><b>" + res['name'] + "</b> <br/>" + res['address']+"<br/>"+res['city']+ ",&nbsp;" +res['state'] + "&nbsp;" + res['zip']  + "</a>";
					
					 console.log(text);
					$('.address-right').append(text).val(res['id']);
					$('.address-right').append('<br><a class="btn my-btn btn-delete btn-danger" data-href="'
					+res['id']+'" data-toggle="modal" data-target="#confirm-court" href="#" style="margin-left:16px"><i class="fa fa-trash-o trash" aria-hidden="true"></i>Delete</a>');
					
					$('#myCourts').modal('hide');
					$('#addcourts')[0].reset();
				
				setTimeout(function(){location.reload();}, 100); 
				}
				else{
					var errors = res['errors'];
					var text = '';
					for(i in errors){
						text += errors[i][0] + '\n';
					}
					alert(text);
				}
				 
			}
			
			
		});
		
		return false;
	});
	
});
