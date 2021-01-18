var app = angular.module('CsrModel', []);
app.controller('CsrController', function($scope, $http) 
{
	
	
	$scope.VillageList = function()
	{
		jQuery('.black_overlay').show();
		$http.get(jQuery('#WebAppURL').val()+'village/VillageListData'+location.search)
		.success(function (response) 
		{
			//alert(response);
			$scope.VillageData = response;
			$scope.reverse = true;
			jQuery('.black_overlay').hide();
		});
	}

    
	$scope.DeleteVillage = function(Id) 
	{
		if(confirm('Do you want to delete?'))
		{
			var URL = jQuery('#WebAppURL').val()+'village/DeleteVillage'+"?id="+Math.random();	
			jQuery.ajax({
				url : URL,
				type: "POST",
				data : {Id:Id},
				success: function(data)
				{
					jQuery('#'+Id).remove();
				}
			});
		}
	}	
	
	$scope.order = function(predicate) {
		$scope.reverse = ($scope.predicate === predicate) ? !$scope.reverse : false;
		$scope.predicate = predicate;
	};
	
	$scope.sort = function(keyname){
		$scope.sortKey = keyname; 
		$scope.reverse = !$scope.reverse;
	}
	
	
});

function ChkOtherDesignation(DisName,otherTime)
{
	if(DisName=='Other')
	{
		jQuery('.OtherDesignationName').show();
	}
	else
	{
		jQuery('.OtherDesignationName').hide();
	}
}