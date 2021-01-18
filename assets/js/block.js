var app = angular.module('CsrModel', []);
app.controller('CsrController', function($scope, $http)
{
	
	
	$scope.BlockList = function()
	{
		jQuery('.black_overlay').show();
		$http.get(jQuery('#WebAppURL').val()+'block/BlockListData')
		.success(function (response) 
		{
			$scope.BlockData = response;
			$scope.reverse = true;
			jQuery('.black_overlay').hide();
		});
	}

    $scope.SearchBlock = function()
    {

        var URL = jQuery('#WebAppURL').val()+'block/SearchBlock'+"?"+$.param($scope.formData);
        //alert(URL);
        jQuery.ajax({
            url : URL,
            type: "POST",
            data : {},
            success: function(data)
            {
            	alert(data);
                $scope.BlockData = data;
                $scope.reverse = true;
                //jQuery('.black_overlay').hide();
            }
        });
    }
	
	$scope.DeleteBlock = function(Id) 
	{
		if(confirm('Do you want to delete?'))
		{
			var URL = jQuery('#WebAppURL').val()+'block/DeleteBlock'+"?id="+Math.random();	
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