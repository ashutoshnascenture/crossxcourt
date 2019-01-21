	function Product($scope,$parse,$http){
		 
		$scope.marketplaces = marketplace;
		 
		$scope.associated_places = {};
		$scope.removeBulk = [];
		$scope.products   = [];
		if(typeof associated_places != 'undefined' && Object.keys(associated_places).length  > 0){
			$scope.associated_places = associated_places;
		}
		 
		$scope.marketplace = function(marketplace_id) {
		
			if(marketplace_id in $scope.associated_places){
				delete $scope.associated_places[marketplace_id]; 
			}
			else {
				for(i in $scope.marketplaces){
					if($scope.marketplaces[i].id == marketplace_id){
						$scope.associated_places[marketplace_id] = $scope.marketplaces[i];
						break;
					}
				}
				
			}
			
		}
		$scope.cb_select_all = function(){
			$scope.removeBulk = [];
			if($scope.select_all){ 
				$('.cb-select').each(function(){
					$(this).prop("checked", true);
					$scope.removeBulk.push($(this).val());
				});
			}
			else{
				$('.cb-select').each(function(){
					$(this).removeAttr('checked');
				});
				
			}
		}
		$scope.stateChanged = function (qId) {
		
		   if($scope.products[qId]){ //If it is checked
			    $scope.removeBulk.push(qId);
		   }
		   else{
				var index = $scope.removeBulk.indexOf(qId);
				$scope.removeBulk.splice( index,1);
		   }
		   console.log($scope.removeBulk);
		}
		 
		$('#deleteBulk').submit(function(){
			if(Object.keys($scope.removeBulk).length == 0){
				alert('Please select at least 1 product');
				return false;
			}
			
		});
	}
