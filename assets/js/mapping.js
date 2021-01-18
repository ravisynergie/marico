var app = angular.module('CsrModel', []);
app.controller('CsrController', function($scope, $http)
{


    $scope.MappingList = function()
    {
        //alert('call');
        jQuery('.black_overlay').show();
        $http.get(jQuery('#WebAppURL').val()+'mapping/MappingListData')
            .success(function (response)
            {
                //alert(response);
                $scope.MappingData = response;
                $scope.reverse = true;
                jQuery('.black_overlay').hide();
            });
    }

    $scope.OpenMappingData= function(Id)
    {
        //alert('deepak');
        var PageURL='/marico/mapping/MappedDataPopup';

       // alert(Id);
        jQuery('#MaricoModal #ModalLightBody').html('<div class="load-more">Loading...</div>');
        jQuery("#MaricoModal").modal('show');
        //jQuery('#ModalLightTitle').html(jsObj.PageTitle);
        jQuery.ajax({
            url : PageURL,
            type: "POST",
            data : {UserId:Id},
            success: function(response)
            {
                jQuery('#MaricoModal #ModalLightBody').html(response);

                jQuery('#MaricoModal .modal-dialog').css('width','80%');

            }
        });
    }


});
// function getSchool(Id){
//     alert('deepak');
//     alert(Id);
//     var URL = <?php echo base_url(); ?>+'mapping/GetDistrictSchool'+"?id="+Math.random();
//     jQuery.ajax({
//         url : URL,
//         type: "POST",
//         data : {Id:Id},
//         success: function(data)
//         {
//             jQuery('#'+Id).remove();
//         }
//     });
//
//
// }