<?php
//if($_GET['debug']==1){
//echo '<pre>';
//print_r($AssessmentData);
//echo '</pre>';
$PrimaryData=array();
$MiddleData=array();
$SeniorData=array();
$YLavel = array('A1','B1','C1','D1');
foreach ($YLavel as $Lavel){
    foreach ($StudentScoringData as $k=>$AssessData){
        if($AssessData[$Lavel] == 1){
            if($AssessData['Class'] >=1 && $AssessData['Class'] <=4){

                $PrimaryData[$Lavel]['Primary'] += 1;
            }
            if($AssessData['Class'] >=5 && $AssessData['Class'] <=8){

                $MiddleData[$Lavel]['Middle'] += 1;
            }

            if($AssessData['Class'] >=9){

                $SeniorData[$Lavel]['Senior'] += 1;
            }
        }
    }
}

$PrimaryCount=array();
$MiddleCount=array();
$SeniorCount=array();
foreach ($YLavel as $Lavel){

    $PrimaryCount[]=$PrimaryData[$Lavel]['Primary'];
    $MiddleCount[]=$MiddleData[$Lavel]['Middle'];
    $SeniorCount[]=$SeniorData[$Lavel]['Senior'];

}


//echo '<pre>';
//print_r($PrimaryCount);
//echo '</pre>';
//
//echo '<pre>';
//print_r($MiddleCount);
//echo '</pre>';
//
//echo '<pre>';
//print_r($SeniorCount);
//echo '</pre>';

//}

$OnlinePrimaryData=array();
$OnlineMiddleData=array();
$OnlineSeniorData=array();
$OnlineYLavel = array('A1','B1','C1','D1');
foreach ($OnlineYLavel as $OnlineLavel){
    foreach ($OnlineStudentScoringData as $k=>$OnlineAssessData){
        if($OnlineAssessData[$OnlineLavel] == 1){
            if($OnlineAssessData['Class'] >=1 && $OnlineAssessData['Class'] <=4){

                $OnlinePrimaryData[$OnlineLavel]['Primary'] += 1;
            }
            if($OnlineAssessData['Class'] >=5 && $OnlineAssessData['Class'] <=8){

                $OnlineMiddleData[$OnlineLavel]['Middle'] += 1;
            }

            if($OnlineAssessData['Class'] >=9){

                $OnlineSeniorData[$OnlineLavel]['Senior'] += 1;
            }
        }
    }
}

$OnlinePrimaryCount=array();
$OnlineMiddleCount=array();
$OnlineSeniorCount=array();
foreach ($YLavel as $Lavel){

    $OnlinePrimaryCount[]=$OnlinePrimaryData[$OnlineLavel]['Primary'];
    $OnlineMiddleCount[]=$OnlineMiddleData[$OnlineLavel]['Middle'];
    $OnlineSeniorCount[]=$OnlineSeniorData[$OnlineLavel]['Senior'];

}


?>

<script>

    var barChartData4 = {
        labels: ['<?php echo implode("','",$YLavel);?>'],
        datasets: [{
            label: 'PRIMARY',
            backgroundColor: ['#FFCF69','#FFCF69','#FFCF69','#FFCF69'],
            borderWidth: 1,
            data: ['<?php echo implode("','",$PrimaryCount);?>']

        },{
            label: 'MIDDLE',
            backgroundColor: ['#FE6585','#FE6585','#FE6585','#FE6585'],
            borderWidth: 1,
            data: ['<?php echo implode("','",$MiddleCount);?>']

        },{
            label: 'SENIOR',
            backgroundColor: ['#00CEFF','#00CEFF','#00CEFF','#00CEFF'],
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





    var barChartData9 = {
        labels: ['<?php echo implode("','",$OnlineYLavel);?>'],
        datasets: [{
            label: 'PRIMARY',
            backgroundColor: ['#FFCF69','#FFCF69','#FFCF69','#FFCF69'],
            borderWidth: 1,
            data: ['<?php echo implode("','",$OnlinePrimaryCount);?>']

        },{
            label: 'MIDDLE',
            backgroundColor: ['#FE6585','#FE6585','#FE6585','#FE6585'],
            borderWidth: 1,
            data: ['<?php echo implode("','",$OnlineMiddleCount);?>']

        },{
            label: 'SENIOR',
            backgroundColor: ['#00CEFF','#00CEFF','#00CEFF','#00CEFF'],
            borderWidth: 1,
            data: ['<?php echo implode("','",$OnlineSeniorCount);?>']

        }]

    };

    var barchart9options = {
        type: 'bar',
        data: barChartData9,
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


    var barchart9ctx = document.getElementById('barChart9').getContext('2d');
    var barChart9Click =  new Chart(barchart9ctx, barchart9options);

    document.getElementById("barChart9").onclick = function(evt){
        var activePoints = barChart9Click.getElementsAtEvent(evt);
        var firstPoint = activePoints[0];
        var label = barChart9Click.data.labels[firstPoint._index];
        var value = barChart9Click.data.datasets[firstPoint._datasetIndex].data[firstPoint._index];
        if (firstPoint !== undefined)
            alert(label + ": " + value);
    };
</script>