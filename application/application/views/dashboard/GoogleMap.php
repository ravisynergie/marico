<!DOCTYPE html>
<html>
<?php

/*
$GoogleMapData2=array();
$tmpData=array();
$tmpData['placeName']='Australia (Uluru)';
$tmpData['AddressInfo']='Ravi - Australia (Uluru)';
$tmpData['type']='District';
$tmpData['LatLng'][]=array('lat'=>26.462891,'lng'=>80.323357);

$GoogleMapData2[]=$tmpData;


echo "<pre>";
print_r($GoogleMapData2);
echo "</pre>";

echo "<pre>";
print_r($DistrictInfo);
echo "</pre>";


echo "<pre>";
print_r($DistrictInfo);
echo "</pre>";
*/

?>
<head>
    <style>
        /*  <span class="metadata-marker" style="display: none;" data-region_tag="css"></span>       Set the size of the div element that contains the map */
        #map {
            height:500px;
            width: 100%;
        }
    </style>
    <script>
        var map;
        var InforObj = [];
        var centerCords = {
            lat: <?php echo $GoogleMapData['0']['LatLng']['0']['lat'];?>,
            lng: <?php echo $GoogleMapData['0']['LatLng']['0']['lng'];?>
        };
        var markersOnMap = <?php echo json_encode($GoogleMapData);?>;
		
		var iconBase = 'https://www.synergieinsights.com/marico/assets/img/';
		var icons = {
		  District: {
			icon: iconBase + 'district_01.png'
		  },
		  School: {
			icon: iconBase + 'school_01.png'
		  },
		  Block: {
			icon: iconBase + 'block_03.png'
		  }
		};
 
        window.onload = function () {
            initMap();
        };
 
        function addMarkerInfo() {
            for (var i = 0; i < markersOnMap.length; i++) {
                var contentString = '<div id="content"><h1>' + markersOnMap[i].placeName +
                    '</h1><p>'+markersOnMap[i].AddressInfo+'</p></div>';
					
				
				
 
                const marker = new google.maps.Marker({
                    position: markersOnMap[i].LatLng[0],
					icon: icons[markersOnMap[i].type].icon,
                    map: map
                });
 
                const infowindow = new google.maps.InfoWindow({
                    content: contentString,
                    maxWidth: 400
                });
 
                marker.addListener('click', function () {
                    closeOtherInfo();
                    infowindow.open(marker.get('map'), marker);
                    InforObj[0] = infowindow;
                });
                // marker.addListener('mouseover', function () {
                //     closeOtherInfo();
                //     infowindow.open(marker.get('map'), marker);
                //     InforObj[0] = infowindow;
                // });
                // marker.addListener('mouseout', function () {
                //     closeOtherInfo();
                //     infowindow.close();
                //     InforObj[0] = infowindow;
                // });
            }
        }
 
        function closeOtherInfo() {
            if (InforObj.length > 0) {
                /* detach the info-window from the marker ... undocumented in the API docs */
                InforObj[0].set("marker", null);
                /* and close it */
                InforObj[0].close();
                /* blank the array */
                InforObj.length = 0;
            }
        }
 
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 8,
                center: centerCords
            });
            addMarkerInfo();
        }
    </script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/adminlte.css">

</head>


<body>

<!--<table id="MaricoTableData" class="table table-bordered dataTable no-footer" role="grid" aria-describedby="MaricoTableData_info">-->
<!--<thead>-->
<!--	<tr><th style="text-align:right">Number of blocks </th><td>--><?php //echo $DistrictInfo['BlockCount'];?><!--</td>-->
<!--    <th style="text-align:right">Total no. of Schools </th><td>--><?php //echo $DistrictInfo['SchoolCount'];?><!--</td>-->
<!--    <th style="text-align:right">No. of Model Schools </th><td>--><?php //echo $DistrictInfo['ModernSchoolCount'];?><!--</td>-->
<!--    <th style="text-align:right">Total no. of students </th><td>--><?php //echo $DistrictInfo['StudentCount'];?><!--</td></tr>-->
<!--</thead>-->
<!--</table>-->
<div class="row">
    <div class="col-md-3" >NUMBER OF PROJECT BLOCKS</div>
    <div class="col-md-2" style="text-align: left;"><?php echo $DistrictInfo['BlockCount'];?></div>
</div>
<div class="row">
    <div class="col-md-3" >TOTAL NO. OF SCHOOLS</div>
    <div class="col-md-2" style="text-align: left;"><?php echo $DistrictInfo['SchoolCount'];?></div>
</div>
<div class="row">
    <div class="col-md-3" >NO. OF MODEL SCHOOLS</div>
    <div class="col-md-2" style="text-align: left;"><?php echo $DistrictInfo['ModernSchoolCount'];?></div>
</div>
<div class="row">
    <div class="col-md-3" >TOTAL NO. OF STUDENTS</div>
    <div class="col-md-2" style="text-align: left;"><?php echo $DistrictInfo['StudentCount'];?></div>
</div>
<br>
<div class="col-md-12 mrt-40 mp0 modern-schools" ><img style="width: 20%;float: right; " src="<?php echo base_url(); ?>assets/img/map-legends.png"/></div>
         
    <div id="map"></div>
 	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAd6-z-om48fTSM8vzcf7oJh08GMtqum1M"></script>
<br>

</body>
 
</html>