var app = angular.module('CsrModel', []);
app.controller('CsrController', function($scope, $http)
{


    $scope.AssessmentList = function()
    {
        jQuery('.black_overlay').show();
        $http.get(jQuery('#WebAppURL').val()+'assessment/AssessmentListData'+location.search)
            .success(function (response)
            {
                //alert(response);
                $scope.AssessmentData = response;
                $scope.reverse = true;
                jQuery('.black_overlay').hide();
            });
    }

    $scope.OpenQuestionData= function(Id)
    {
        //alert('deepak');
        var PageURL='/marico/assessment/QuestionDataPopup';

        //alert(Id);
        jQuery('#MaricoModal #ModalLightBody').html('<div class="load-more">Loading...</div>');
        jQuery("#MaricoModal").modal('show');
        //jQuery('#ModalLightTitle').html(jsObj.PageTitle);
        jQuery.ajax({
            url : PageURL,
            type: "POST",
            data : {Id:Id},
            success: function(response)
            {
                jQuery('#MaricoModal #ModalLightBody').html(response);

                jQuery('#MaricoModal .modal-dialog').css('width','80%');

            }
        });
    }

    $scope.DeleteAssessment = function(Id)
    {
        if(confirm('Do you want to delete?'))
        {
            var URL = jQuery('#WebAppURL').val()+'assessment/DeleteAssessment'+"?id="+Math.random();
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

