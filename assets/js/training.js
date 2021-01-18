var app = angular.module('CsrModel', []);
app.controller('CsrController', function($scope, $http)
{


    $scope.TrainingList = function()
    {
        jQuery('.black_overlay').show();
        $http.get(jQuery('#WebAppURL').val()+'training/TrainingListData'+location.search)
            .success(function (response)
            {
                $scope.TrainingData = response;
                $scope.reverse = true;
                jQuery('.black_overlay').hide();
            });
    }

    $scope.MeetingList = function()
    {
        jQuery('.black_overlay').show();
        $http.get(jQuery('#WebAppURL').val()+'meeting/MeetingListDataActivity'+location.search)
            .success(function (response)
            {
                //alert(response);
                $scope.MeetingData = response;
                $scope.reverse = true;
                jQuery('.black_overlay').hide();
            });
    }

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
    

    $scope.DeleteTraining = function(Id)
    {

        if(confirm('Do you want to delete?'))
        {
            var URL = jQuery('#WebAppURL').val()+'training/DeleteTraining'+"?id="+Math.random();
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