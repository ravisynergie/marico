<?php
//$IVRStudentData=$this->trainingmodel->IVRStudentData($FilterData);
$IVRGraphData['0-50']=0;
$IVRGraphData['51-100']=0;
$IVRGraphData['101-150']=0;
$IVRGraphData['151-200']=0;
foreach($IVRStudentData as $tmpIvr)
{
	$NumberOfIVRCompleted=json_decode($tmpIvr['NumberOfIVRCompleted']);
	foreach($NumberOfIVRCompleted as $tmpTimes)
	{
		if($tmpTimes)
		{
			if($tmpTimes>0 && $tmpTimes<=50)
			{
				$IVRGraphData['0-50']+=1;
			}
			elseif($tmpTimes>51 && $tmpTimes<=100)
			{
				$IVRGraphData['51-100']+=1;
			}
			elseif($tmpTimes>100 && $tmpTimes<=150)
			{
				$IVRGraphData['101-150']+=1;
			}
			elseif($tmpTimes>150 && $tmpTimes<=200)
			{
				$IVRGraphData['151-200']+=1;
			}
		}
	}		
}

//echo "<pre>";
//print_r($IVRGraphData);
//echo "</pre>";
//die;
?>

<script>

     var barChartData2 = {
        labels: ['0-50','51-100','101-150','151-200'],
        datasets: [{
            label: 'IVR COMPLETED',
            backgroundColor: ['#FE6585','#FE6585','#FE6585','#FE6585','#FE6585','#FE6585'],
            borderWidth: 1,
            data: ['<?php echo $IVRGraphData['0-50'];?>','<?php echo $IVRGraphData['51-100'];?>','<?php echo $IVRGraphData['101-150'];?>','<?php echo $IVRGraphData['151-200'];?>']

        }]

    };

    var barchart2options = {
        type: 'bar',
        data: barChartData2,
        options: {
            plugins: {
                labels: {
                    fontSize: 0
                }
            },
            responsive: true,
            legend: {
                position: 'top',
                display: false,
                text:''
            },
            title: {
                display: true,
                text: 'IVR Modules Progress'
            },
            scales: {
                xAxes: [{
                    barPercentage: 0.4,
                    barThickness : 20,
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'NUMBER OF IVR MODULES COMPLETED',
                        fontSize: 14,
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'NUMBER OF STUDENTS',
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


    var barchart2ctx = document.getElementById('barChart2').getContext('2d');
    var barChart2Click =  new Chart(barchart2ctx, barchart2options);

    document.getElementById("barChart2").onclick = function(evt){
        var activePoints = barChart2Click.getElementsAtEvent(evt);
        var firstPoint = activePoints[0];
        var label = barChart2Click.data.labels[firstPoint._index];
        var value = barChart2Click.data.datasets[firstPoint._datasetIndex].data[firstPoint._index];
        if (firstPoint !== undefined)
            alert(label + ": " + value);
    };

    //----------------------End LEARNING AREAS BY IMPACT Bar Chart-------------------------------------------------------------

</script>