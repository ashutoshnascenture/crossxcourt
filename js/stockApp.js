	function Stock($scope,$parse,$http){
		$scope.product = '';
		$scope.getProduct =  function() {
			var response = $http.get(siteUrl+"/marketplaces/get_product/"+$scope.sku);
			response.success(function(res, status, headers, config) {
				if(res.status == 200){
					$scope.product_name = res.data.name;
					$scope.product = res.data;
				}
				else { 
					$scope.product_name = '';
					$scope.product = '';
				}
					
			});
			 
		}
		$('#add-stock-form').submit(function() {
			if($scope.product == ''){
				alert('Please enter correct product sku.');
				return false;
			}
		});
	}
