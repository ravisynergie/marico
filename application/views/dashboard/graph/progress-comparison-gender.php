<?php
//if($_GET['debug']==1){

$MaleData=array();
$FemaleData=array();
foreach ($AssessmentData as $key=>$Assessment)
{
    foreach ($Assessment as $k=>$AssessData)
	{
        if($AssessData['TotalMarks']>2)
		{
            if($AssessData['StudentGender'] == 'Male')
			{
				$MaleData[$key]['Male'] += 1;
            }
            if($AssessData['StudentGender'] == 'Female')
			{
				$FemaleData[$key]['Female'] += 1;
            }
        }
    }
}

$MaleCount=array();
$FemaleCount=array();
foreach ($MaleData as $male) 
{
	$MaleCount[]=$male['Male'];
}
foreach ($FemaleData as $female) 
{
	$FemaleCount[]=$female['Female'];
}

//    echo '<pre>';
//    print_r($MaleCount);
//    echo '</pre>';
//
//    echo '<pre>';
//    print_r($FemaleCount);
//    echo '</pre>';

//}
?>
<script>

    var barChartData3 = {
        labels: ['<?php echo implode("','",array_keys($AssessmentData));?>'],
        datasets: [{
            label: 'BOYS',
            backgroundColor: ['#807878','#807878','#807878'],
            borderWidth: 1,
            data: ['<?php echo implode("','",$MaleCount);?>']

        },{
            label: 'GIRLS',
            backgroundColor: ['#FE6585','#FE6585','#FE6585'],
            borderWidth: 1,
            data: ['<?php echo implode("','",$FemaleCount);?>']

        }]

    };

    var barchart3options = {
        type: 'bar',
        data: barChartData3,
        options: {
            plugins: {
                labels: {
                    fontSize: 0
                }
            },
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'COMPARISON BY GENDER'
            },
            scales: {
                xAxes: [{
                    barPercentage: 0.4,
                    barThickness : 20,
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'IMPACT ACHIEVED',
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


    var barchart3ctx = document.getElementById('barChart3').getContext('2d');
    var barChart3Click =  new Chart(barchart3ctx, barchart3options);

    document.getElementById("barChart3").onclick = function(evt){
        var activePoints = barChart3Click.getElementsAtEvent(evt);
        var firstPoint = activePoints[0];
        var label = barChart3Click.data.labels[firstPoint._index];
        var value = barChart3Click.data.datasets[firstPoint._datasetIndex].data[firstPoint._index];
        if (firstPoint !== undefined)
            alert(label + ": " + value);
    };

    //-----------------------------------------------------------------------------------

</script>