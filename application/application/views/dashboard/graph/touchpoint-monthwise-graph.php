<?php
usort($TrainingData, 'Compare_TrainingDate');
$LineChartXLabel=array();
foreach($TrainingData as $tmpData)
{
	if(strtotime($tmpData['TrainingDate'])>strtotime('2019-09-01'))
	{
		$tmpMonth=date('M Y',strtotime($tmpData['TrainingDate']));
		$LineChartXLabel[$tmpMonth]=$tmpMonth;
	}
}
//ksort($LineChartXLabel);
//echo "<pre>";
//print_r($LineChartXLabel);
//echo "</pre>";


$LineVendorMonthDis=array();
foreach($TrainingData as $tempRegData)
{
	if(strtotime($tmpData['TrainingDate'])>strtotime('2019-09-01'))
	{
		$DistributionDate=date('M Y',strtotime($tempRegData['TrainingDate']));
		$LineVendorMonthDis[$tempRegData['DistrictName']][$DistributionDate]+=1;
	}
}
//ksort($LineChartXLabel);
//echo "<pre>";
//print_r($LineVendorMonthDis);
//echo "</pre>";


$LineChartYLabel=array();

foreach($LineVendorMonthDis as $VendorName=>$tmpData)
{
	$tmpArray=array();
	$tmpArray['label']=$VendorName;
	//$ColorCode=randomHex();
	//$tmpArray['borderColor']=array($ColorCode);
	//$ColorCode=randomHex();
	//$tmpArray['pointBackgroundColor']=array($ColorCode);
	$ColorCode=randomHex();
	$tmpArray['backgroundColor']=array($ColorCode);
	$tmpArray['borderColor']=array($ColorCode);
	$tmpArray['pointBackgroundColor']=array($ColorCode);
	$tmpArray['pointBorderColor']=array($ColorCode);
	
	
	$tmpDis=array();
	foreach($LineChartXLabel as $monthYear)
	{
		if($tmpData[$monthYear]=='') $tmpData[$monthYear]=0;
		$tmpDis[]=$tmpData[$monthYear];
	}
	$tmpArray['data']=$tmpDis;
	$tmpArray['fill']=false;
	
	$LineChartYLabel[]=$tmpArray;
}

//echo "<pre>";
//print_r($TouchpointData);
//echo "</pre>";
//
//echo "<pre>";
//print_r($LineVendorMonthDis);
//echo "</pre>";
//

/*
echo "<pre>";
print_r($LineChartYLabel);
echo "</pre>";


echo "<pre>";
print_r($LineChartXLabel);
echo "</pre>";
die;
*/


function Compare_TrainingDate($a, $b)
{
	return strnatcmp($a['TrainingDate'],$b['TrainingDate']);
}
?>

<script>


    var chartColors = {
        red: 'rgb(255, 99, 132)',
        orange: 'rgb(255, 159, 64)',
        yellow: 'rgb(255, 205, 86)',
        green: 'rgb(75, 192, 192)',
        blue: 'rgb(54, 162, 235)',
        purple: 'rgb(153, 102, 255)',
        grey: 'rgb(231,233,237)'
    };

    var randomScalingFactor = function() {
        return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
    }
    var config = {
        type: 'line',
        data: {
            labels: ['<?php echo implode("','",$LineChartXLabel);?>'],
			datasets: <?php echo json_encode($LineChartYLabel);?>
            /*
			datasets: [{
                label: "Kanpur Nagar",
                backgroundColor: '#00D500',
                borderColor: '#00D500',
                pointBackgroundColor: "#fff",
                data: [0,15,24,36,12,36,24],
                fill: false,
            },{
                label: "Kanpur Dehat",
                backgroundColor: '#d53338',
                borderColor: '#d53338',
                pointBackgroundColor: "#fff",
                data: [0,25,44,36,52,60,70],
                fill: false,
            },{
                label: "Fatehpur",
                backgroundColor: '#6084d5',
                borderColor: '#6084d5',
                pointBackgroundColor: "#fff",
                data: [0,15,20,32,41,52,60],
                fill: false,
            },{
                label: "Kannauj",
                backgroundColor: '#ffd110',
                borderColor: '#ffd110',
                pointBackgroundColor: "#fff",
                data: [0,20,22,15,25,40,50],
                fill: false,
            }]*/
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: ''
            },
            tooltips: {
                mode: 'label',
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'MONTH',
                        fontSize: 14,
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'NUMBER OF TOUCHPOINTS'
                    }
                }]
            }
        }
    };


    var ctx = document.getElementById("barLine1").getContext("2d");
    window.myLine = new Chart(ctx, config);


</script>