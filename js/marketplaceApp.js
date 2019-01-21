function Marketplace($scope,$parse,$http){
	
	if( typeof shipping_categories == 'undefined'){
		$scope.shipping_categories = [0]; //for add page
	}
	else {
		$scope.shipping_categories = shipping_categories; //for edit page
	}
	//function for create multiple category	
	$scope.addMore = function(){
		var index = $scope.shipping_categories.length;
		$scope.shipping_categories.push(index); 
	}
	//function for remove dynamically created category
	$scope.removeCategory = function(array,index){
		array.splice(index,1); 
	}
			
}
$('#name').keyup(function(){
	var name = $(this).val();
	
	if (name.toLowerCase().indexOf("swiss") >= 0){
		var type = 'swiss';
		var remove = 'dutch';
	}
	else if(name.toLowerCase().indexOf("dutch") >= 0){
		var type = 'dutch';
		var remove = 'swiss';
	}
	if(type){
		$('.control-label').each(function(){
			var text = $(this).text();
			if(text.toLowerCase().indexOf(remove) >= 0 ){	 
				$(this).parents('.form-group').hide();
			}
			else {
				$(this).parents('.form-group').show();
			} 
		});
		var str = name.toLowerCase().replace(type, "").trim();
		var last = str.charAt(str.length - 1);
		if(last == '/' || last == '-'){
			str = str.substring(0, str.length - 1).trim();
		}
		$('#type').val(type);
		$('#place').val(str);
	}
	 
});