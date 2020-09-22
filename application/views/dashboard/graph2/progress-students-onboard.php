<?php
usort($StudentData, 'Compare_DateCreated');
$LineChartXLabel=array();
foreach($StudentData as $tmpData)
{
	if($tempRegData['DistrictName'])
	{
		$tmpMonth=date('M Y',strtotime($tmpData['DateCreated']));
		$LineChartXLabel[$tmpMonth]=$tmpMonth;	
	}
}


$LineVendorMonthDis=array();
foreach($StudentData as $tempRegData)
{
	if($tempRegData['DistrictName'])
	{
		$DistributionDate=date('M Y',strtotime($tempRegData['DateCreated']));
		$LineVendorMonthDis[$tempRegData['DistrictName']][$DistributionDate]+=1;
	}
}

$LineChartYLabel=array();
foreach($LineVendorMonthDis as $VendorName=>$tmpData)
{
	$tmpArray=array();
	$tmpArray['label']=$VendorName;
	$ColorCode=randomHex();
	$tmpArray['backgroundColor']=array($ColorCode);
	$tmpArray['borderColor']=array($ColorCode);
	
	
	$tmpDis=array();
	foreach($LineChartXLabel as $monthYear)
	{
		if($tmpData[$monthYear]=='') $tmpData[$monthYear]=0;
		$tmpDis[]=$tmpData[$monthYear];
	}
	$tmpArray['data']=$tmpDis;
	$tmpArray['fill']='true';
	
	$LineChartYLabel[]=$tmpArray;
}


//    echo "<pre>";
//    print_r($LineChartYLabel);
//    echo "</pre>";

    $FinalLineChartYLabel = array();
    $FinalLineChartYLabel = $LineChartYLabel;


    $ForTotal = array();
    $ForTotal['label'] = 'Total';
    $ForTotal['backgroundColor']=array(randomHex());
    $ForTotal['borderColor']=$ForTotal['backgroundColor'];
    $ForTotal['fill']='true';
    $tmpArr = array();
    foreach ($LineChartYLabel as $key=>$Total){
        foreach ($Total['data'] as $k=>$TData){

            $tmpArr[$k] += $Total['data'][$k];

        }
        $ForTotal['data'] = $tmpArr;
    }
    array_push($FinalLineChartYLabel,$ForTotal);

if($_GET['Debug'] == 1) {
    echo "<pre>";
    print_r($FinalLineChartYLabel);
    echo "</pre>";

}
/*
echo "<pre>";
print_r($StudentData);
echo "</pre>";
*/
function Compare_DateCreated($a, $b)
{
	return strnatcmp($a['DateCreated'],$b['DateCreated']);
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
    var barline2config = {
        type: 'line',
        data: {
            labels: ['<?php echo implode("','",$LineChartXLabel);?>'],
			datasets: <?php echo json_encode($FinalLineChartYLabel);?>
            /*datasets: [{
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
                text: 'Students Onboarded'
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
                        labelString: 'NUMBER OF STUDENTS',
                        fontSize: 14,
                    }
                }]
            }
        }
    };


    var barline2ctx = document.getElementById("barLine2").getContext("2d");
    window.myLine = new Chart(barline2ctx, barline2config);


</script>