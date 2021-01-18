var app = angular.module('CsrModel', []);
app.controller('CsrController', function($scope, $http)
{


    $scope.EventList = function()
    {
        jQuery('.black_overlay').show();
        $http.get(jQuery('#WebAppURL').val()+'event/EventListData'+location.search)
            .success(function (response)
            {
                $scope.EventData = response;
                $scope.reverse = true;
                jQuery('.black_overlay').hide();
            });
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
