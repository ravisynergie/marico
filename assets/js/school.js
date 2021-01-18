var app = angular.module('CsrModel', []);
app.controller('CsrController', function($scope, $http) 
{
	
	
	$scope.SchoolList = function()
	{
		jQuery('.black_overlay').show();
		$http.get(jQuery('#WebAppURL').val()+'school/SchoolListData'+location.search)
		.success(function (response) 
		{
			$scope.SchoolData = response;
			$scope.reverse = true;
			jQuery('.black_overlay').hide();
		});
	}

    $scope.SearchSchool= function()
    {

        var URL = jQuery('#WebAppURL').val()+'school/SearchSchool'+"?"+$.param($scope.formData);
        alert(URL);
        jQuery.ajax({
            url : URL,
            type: "POST",
            data : {},
            success: function(data)
            {
                alert(data);
                $scope.SchoolData = data;
                $scope.reverse = true;
                $scope.refresh();
                //jQuery('.black_overlay').hide();
            }
        });
    }
	
	$scope.DeleteSchool = function(Id) 
	{
		if(confirm('Do you want to delete?'))
		{
			var URL = jQuery('#WebAppURL').val()+'school/DeleteSchool'+"?id="+Math.random();	
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