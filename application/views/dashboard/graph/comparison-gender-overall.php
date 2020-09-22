<?php
//if($_GET['debug']==1){
//echo '<pre>';
//print_r($StudentData);
//echo '</pre>';
$MaleData=array();
$FemaleData=array();

$MaleFemale=array();

foreach ($StudentData as $key=>$SData) {
    if($SData['Gender'] == 'Male'){
        $MaleFemale['Male'][] = $SData;
    }

    if($SData['Gender'] == 'Female'){
        $MaleFemale['Female'][] = $SData;
    }
}
//echo '<pre>';
    //print_r($MaleFemale);
//echo '</pre>';


foreach ($MaleFemale['Male'] as $key=>$SData){

            if($SData['Class'] >=1 && $SData['Class'] <=4){

                $MaleData['Primary'] += 1;
            }
            if($SData['Class'] >=5 && $SData['Class'] <=8){

                $MaleData['Middle'] += 1;
            }

            if($SData['Class'] >=9){

                $MaleData['Senior'] += 1;
            }

}

foreach ($MaleFemale['Female'] as $key=>$SData){

            if($SData['Class'] >=1 && $SData['Class'] <=4){

                $FemaleData['Primary'] += 1;
            }
            if($SData['Class'] >=5 && $SData['Class'] <=8){

                $FemaleData['Middle'] += 1;
            }

            if($SData['Class'] >=9){

                $FemaleData['Senior'] += 1;
            }

}






$MaleCount=array();
$FemaleCount=array();
$MaleCount['Primary']=$MaleData['Primary'];
$MaleCount['Middle']=$MaleData['Middle'];
$MaleCount['Senior']=$MaleData['Senior'];

$FemaleCount['Primary']=$FemaleData['Primary'];
$FemaleCount['Middle']=$FemaleData['Middle'];
$FemaleCount['Senior']=$FemaleData['Senior'];


//echo '<pre>';
//print_r($MaleCount);
//echo '</pre>';
////
//echo '<pre>';
//print_r($FemaleCount);
//echo '</pre>';


//}
?>

<script>

    var barChartData5 = {
        labels: ['Primary','Middle','Senior'],
        datasets: [{
            label: 'MALE',
            backgroundColor: ['#FFCF69','#FFCF69','#FFCF69'],
            borderWidth: 1,
            data: ['<?php echo implode("','",$MaleCount);?>']

        },{
            label: 'FEMALE',
            backgroundColor: ['#FE6585','#FE6585','#FE6585'],
            borderWidth: 1,
            data: ['<?php echo implode("','",$FemaleCount);?>']

        }]

    };

    var barchart5options = {
        type: 'bar',
        data: barChartData5,
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
                text: 'COMPARISON BY CLASS OVERALL'
            },
            scales: {
                xAxes: [{
                    barPercentage: 0.4,
                    barThickness : 20,
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: '',
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


    var barchart5ctx = document.getElementById('barChart5').getContext('2d');
    var barChart5Click =  new Chart(barchart5ctx, barchart5options);

    document.getElementById("barChart5").onclick = function(evt){
        var activePoints = barChart5Click.getElementsAtEvent(evt);
        var firstPoint = activePoints[0];
        var label = barChart5Click.data.labels[firstPoint._index];
        var value = barChart5Click.data.datasets[firstPoint._datasetIndex].data[firstPoint._index];
        if (firstPoint !== undefined)
            alert(label + ": " + value);
    };

    //----------------------End LEARNING AREAS BY IMPACT Bar Chart-------------------------------------------------------------

</script>