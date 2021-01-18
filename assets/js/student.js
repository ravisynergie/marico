var app = angular.module('CsrModel', ['angularUtils.directives.dirPagination']);
app.directive('bodyproRepeatDirective', function() {
  return function(scope, element, attrs) {   
  };
})

app.controller('CsrController', function($scope, $http) 
{
	
	
	$scope.StudentList = function()
	{
		jQuery('.black_overlay').show();
		$http.get('https://www.synergieinsights.com/marico/student/StudentListData'+location.search)
		.success(function (response) 
		{
			$scope.StudentData = response;
			$scope.reverse = true;
			jQuery('.black_overlay').hide();
		});
	}

    $scope.SearchStudent= function()
    {

        var URL = jQuery('#WebAppURL').val()+'student/SearchStudent'+"?"+$.param($scope.formData);
        alert(URL);
        jQuery.ajax({
            url : URL,
            type: "POST",
            data : {},
            success: function(data)
            {
                alert(data);
                $scope.StudentData = data;
                $scope.reverse = true;
                $scope.refresh();
                //jQuery('.black_overlay').hide();
            }
        });
    }
	
	$scope.DeleteStudent = function(Id) 
	{
		if(confirm('Do you want to delete?'))
		{
			var URL = jQuery('#WebAppURL').val()+'student/DeleteStudent'+"?id="+Math.random();	
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