var app = angular.module('CsrModel', []);
app.controller('CsrController', function($scope, $http)
{


    $scope.UserList = function()
    {
        jQuery('.black_overlay').show();
        $http.get(jQuery('#WebAppURL').val()+'user/UserListData')
            .success(function (response)
            {
                $scope.UserData = response;
                $scope.reverse = true;
                jQuery('.black_overlay').hide();
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