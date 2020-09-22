<?php
//if($_GET['debug']==1){
//echo '<pre>';
//print_r($AssessmentData);
//echo '</pre>';
$PrimaryData=array();
$MiddleData=array();
$SeniorData=array();
foreach ($AssessmentData as $key=>$Assessment){
    foreach ($Assessment as $k=>$AssessData){
        if($AssessData['TotalMarks']>2){
            if($AssessData['StudentClass'] >=1 && $AssessData['StudentClass'] <=4){

                $PrimaryData[$key]['Primary'] += 1;
            }
            if($AssessData['StudentClass'] >=5 && $AssessData['StudentClass'] <=8){

                $MiddleData[$key]['Middle'] += 1;
            }

            if($AssessData['StudentClass'] >=9){

                $SeniorData[$key]['Senior'] += 1;
            }
        }
    }
}

$PrimaryCount=array();
$MiddleCount=array();
$SeniorCount=array();
foreach ($PrimaryData as $male) {
    $PrimaryCount[]=$male['Primary'];

}
foreach ($MiddleData as $female) {
    $MiddleCount[]=$female['Middle'];

}
foreach ($SeniorData as $female) {
    $SeniorCount[]=$female['Senior'];

}



//}
?>

<script>

    var barChartData4 = {
        labels: ['<?php echo implode("','",array_keys($AssessmentData));?>'],
        datasets: [{
            label: 'PRIMARY',
            backgroundColor: ['#FFCF69','#FFCF69','#FFCF69'],
            borderWidth: 1,
            data: ['<?php echo implode("','",$PrimaryCount);?>']

        },{
            label: 'MIDDLE',
            backgroundColor: ['#FE6585','#FE6585','#FE6585'],
            borderWidth: 1,
            data: ['<?php echo implode("','",$MiddleCount);?>']

        },{
            label: 'SENIOR',
            backgroundColor: ['#00CEFF','#00CEFF','#00CEFF'],
            borderWidth: 1,
            data: ['<?php echo implode("','",$SeniorCount);?>']

        }]

    };

    var barchart4options = {
        type: 'bar',
        data: barChartData4,
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
                text: 'COMPARISON BY CLASS'
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


    var barchart4ctx = document.getElementById('barChart4').getContext('2d');
    var barChart4Click =  new Chart(barchart4ctx, barchart4options);

    document.getElementById("barChart4").onclick = function(evt){
        var activePoints = barChart4Click.getElementsAtEvent(evt);
        var firstPoint = activePoints[0];
        var label = barChart4Click.data.labels[firstPoint._index];
        var value = barChart4Click.data.datasets[firstPoint._datasetIndex].data[firstPoint._index];
        if (firstPoint !== undefined)
            alert(label + ": " + value);
    };

    //----------------------End LEARNING AREAS BY IMPACT Bar Chart-------------------------------------------------------------

</script>