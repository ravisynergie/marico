<?php
//echo "<pre>";
//print_r($TouchpointData);
//echo "</pre>";

$TouchGraphData=array();
$SchName=array();
$TrainerName = array();
foreach ($TouchpointData as $tmpData) 
{
	$TouchGraphData[$tmpData['count']]+=1;


}
ksort($TouchGraphData);

foreach ($TouchpointData as $tData)
{
    foreach ($TouchGraphData as $key=>$gData){
        if($tData['count'] == $key){
            $SchName[$tData['count']]=$tData['LocationName'];
            $TrainerName[$tData['count']]=$tData['TrainerName'];
        }
    }

}

//echo "<pre>";
//print_r($TrainerName);
//echo "</pre>";


//echo "<pre>";
//print_r($SchName);
//echo "</pre>";

$HowMuchTimes=array();
$ItneBar=array();
foreach($TouchGraphData as $Key=>$Val)
{
	$HowMuchTimes[]=$Key;
	$ItneBar[]=	$Val;
}

$DistrictParameter=array('CallType'=>'DistrictData','PageTitle'=>'Districts');
?>
<script>
    var barChartData1 = {
        labels: ['<?php echo implode("','",$HowMuchTimes);?>'],
        datasets: [{
            label: 'Touchpoint',
            backgroundColor: ['#FE6585','#FE6585','#FE6585','#FE6585','#FE6585','#FE6585','#FE6585','#FE6585','#FE6585','#FE6585','#FE6585','#FE6585','#FE6585','#FE6585','#FE6585','#FE6585','#FE6585','#FE6585','#FE6585','#FE6585','#FE6585','#FE6585','#FE6585','#FE6585','#FE6585','#FE6585','#FE6585','#FE6585','#FE6585','#FE6585','#FE6585','#FE6585'],
            borderWidth: 1,
            data: ['<?php echo implode("','",$ItneBar);?>']

        }]

    };

    var options1 = {
        type: 'bar',
        data: barChartData1,
        options: {
            plugins: {
                labels: {
                    fontSize: 0
                }
            },
            responsive: true,
            hover: {
                mode: 'label',
            },
            tooltips: {
                custom: function(tooltip) {
                    if (!tooltip) return;
                    // disable displaying the color box;
                    tooltip.displayColors = false;
                },
                callbacks: {
                    label: function(tooltipItem, data) {
                        var label = data.labels[tooltipItem.index];
                        var val = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                        return 'Schools' + ':' + val;
                    },
                    title: function(tooltipItem, data) {
                        return;
                    }
                }


            },

            legend: {
                position: 'top',
                display: false
            },
            title: {
                display: true,
                text: ''
            },
            scales: {
                xAxes: [{
                    barPercentage: 0.4,
                    barThickness : 20,
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'TOUCHPOINTS',
                        fontSize: 14,
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'NUMBER OF SCHOOLS',
                        fontSize: 14,
                    },
                    ticks: {
                        beginAtZero: true,
                        steps: 10,
                        stepValue: 15,
                    },

                }]
            },
        }
    };


    var ctx1 = document.getElementById('barChart1').getContext('2d');
    var barChartClick =  new Chart(ctx1, options1);

    document.getElementById("barChart1").onclick = function(evt){
        var activePoints = barChartClick.getElementsAtEvent(evt);
        var firstPoint = activePoints[0];
        var label = barChartClick.data.labels[firstPoint._index];
        var value = barChartClick.data.datasets[firstPoint._datasetIndex].data[firstPoint._index];
        if (firstPoint !== undefined)
		{
            //alert(label + ": " + value);
			var PageURL='<?php base_url();?>/marico/dashboard/HandlePopup?DistrictId=<?php echo $_GET['DistrictId'];?>&CallTypeDirect=TouchPointsInSchools&HowMuchTimes='+label;
			jQuery('#MaricoModal #ModalLightBody').html('<div class="load-more">Loading...</div>');
			jQuery("#MaricoModal").modal('show');
			jQuery('#ModalLightTitle').html('');
			jQuery.ajax({
				url : PageURL,
				type: "POST",
				success: function(response)
				{
					jQuery('#MaricoModal #ModalLightBody').html(response);
					jQuery('#MaricoModal .modal-dialog').css('width','90%');					
				}
			});
		}
    };

    //----------------------End LEARNING AREAS BY IMPACT Bar Chart-------------------------------------------------------------

</script>