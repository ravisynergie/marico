var app = angular.module('CsrModel', []);
app.controller('CsrController', function($scope, $http)
{


    $scope.MeetingList = function()
    {
        jQuery('.black_overlay').show();
        $http.get(jQuery('#WebAppURL').val()+'meeting/MeetingListData')
            .success(function (response)
            {
                $scope.MeetingData = response;
                $scope.reverse = true;
                jQuery('.black_overlay').hide();
            });
    }


    $scope.DeleteMeeting = function(Id)
    {

        if(confirm('Do you want to delete?'))
        {
            var URL = jQuery('#WebAppURL').val()+'meeting/DeleteMeeting'+"?id="+Math.random();
            jQuery.ajax({
                url : URL,
                type: "POST",
                data : {Id:Id},
                success: function(data)
                {
                    // alert(Id);
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