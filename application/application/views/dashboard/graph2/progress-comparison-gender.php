<?php
//if($_GET['debug']==1){
//die;
//echo '<pre>';
//print_r($OnlineStudentScoringData);
//echo '</pre>';
$YLavel = array('A1','B1','C1','D1');
$MaleData=array();
$FemaleData=array();
foreach ($YLavel as $Lavel){
    foreach ($StudentScoringData as $k=>$AssessData) {
        if ($AssessData[$Lavel] == 1) {
            if ($AssessData['Gender'] == 'Male') {
                $MaleData[$Lavel]['Male'] += 1;
            }
            if ($AssessData['Gender'] == 'Female') {
                $FemaleData[$Lavel]['Female'] += 1;
            }
        }
    }

 }


$MaleCount=array();
$FemaleCount=array();

foreach ($YLavel as $Lavel){

    $MaleCount[]=$MaleData[$Lavel]['Male'];
    $FemaleCount[]=$FemaleData[$Lavel]['Female'];

    }



//    echo '<pre>';
//    print_r($MaleCount);
//    echo '</pre>';
//
//    echo '<pre>';
//    print_r($FemaleCount);
//    echo '</pre>';

//}




$OnlineYLavel = array('A1','B1','C1','D1');
$OnlineMaleData=array();
$OnlineFemaleData=array();
foreach ($OnlineYLavel as $OnlineLavel){
    foreach ($OnlineStudentScoringData as $k=>$OnlineAssessData) {
        if ($OnlineAssessData[$OnlineLavel] == 1) {
            if ($OnlineAssessData['Gender'] == 'Male') {
                $OnlineMaleData[$OnlineLavel]['Male'] += 1;
            }
            if ($OnlineAssessData['Gender'] == 'Female') {
                $OnlineFemaleData[$OnlineLavel]['Female'] += 1;
            }
        }
    }

}


$OnlineMaleCount=array();
$OnlineFemaleCount=array();

foreach ($OnlineYLavel as $OnlineLavel){

    $OnlineMaleCount[]=$OnlineMaleData[$OnlineLavel]['Male'];
    $OnlineFemaleCount[]=$OnlineFemaleData[$OnlineLavel]['Female'];

}




?>
<script>

    var barChartData3 = {
        labels: ['<?php echo implode("','",$YLavel);?>'],
        datasets: [{
            label: 'BOYS',
            backgroundColor: ['#807878','#807878','#807878','#807878'],
            borderWidth: 1,
            data: ['<?php echo implode("','",$MaleCount);?>']

        },{
            label: 'GIRLS',
            backgroundColor: ['#FE6585','#FE6585','#FE6585','#FE6585'],
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




    var barChartData8 = {
        labels: ['<?php echo implode("','",$OnlineYLavel);?>'],
        datasets: [{
            label: 'BOYS',
            backgroundColor: ['#807878','#807878','#807878','#807878'],
            borderWidth: 1,
            data: ['<?php echo implode("','",$OnlineMaleCount);?>']

        },{
            label: 'GIRLS',
            backgroundColor: ['#FE6585','#FE6585','#FE6585','#FE6585'],
            borderWidth: 1,
            data: ['<?php echo implode("','",$OnlineFemaleCount);?>']

        }]

    };

    var barchart8options = {
        type: 'bar',
        data: barChartData8,
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


    var barchart8ctx = document.getElementById('barChart8').getContext('2d');
    var barChart8Click =  new Chart(barchart8ctx, barchart8options);

    document.getElementById("barChart8").onclick = function(evt){
        var activePoints = barChart8Click.getElementsAtEvent(evt);
        var firstPoint = activePoints[0];
        var label = barChart8Click.data.labels[firstPoint._index];
        var value = barChart8Click.data.datasets[firstPoint._datasetIndex].data[firstPoint._index];
        if (firstPoint !== undefined)
            alert(label + ": " + value);
    };
</script>