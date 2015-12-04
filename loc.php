<html>
<head>
	<link rel="stylesheet" href="assets/styles/index.css" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
<script type="text/javascript">
<script type="text/javascript">


	// var addresses = ['2499 Cedar Creek Street, Santa Rosa, CA', '4474 Poinsettia Court, San Jose, CA', 'Asia','North America','South America'];
	var addresses = ['London, UK'];	
	var map;
	var infowindow = [];

	$(document).ready(function () {
		initialize();
	});

	function initialize(){
	    var map;
	    var myOptions = {
	        zoom: 1,
	        center: new google.maps.LatLng(0, 0),
	        mapTypeId: google.maps.MapTypeId.ROADMAP
	    };
	    map = new google.maps.Map(document.getElementById("Map"), myOptions);
	    addMarkers(map);
   
	}

	function addMarkers(map){
		for (var x = 0; x < addresses.length; x++) {
	        $.getJSON('http://maps.googleapis.com/maps/api/geocode/json?address='+addresses[x]+'&sensor=false', null, function (data) {
	            var p = data.results[0].geometry.location
	            var latlng = new google.maps.LatLng(p.lat, p.lng);
	            new google.maps.Marker({
	                position: latlng,
	                map: map
	            });

	        });
	        //info(iterator);
	    }
	};
</script>
</head>
<body>
	<div class = "title_bg">
		<div class = "title_container">
			<a href="index.html"><img class = "img_head" src="assets/img/logo.png"></a>
		</div>
	</div>
	<div class = "content">
		<?php
		   include 'queriesini.php';
		   include 'mysqlini.php';
		   $queries = array("Users"=>$user_query, "Proj"=>$proj_query, "Orgs"=>$org_query);
		   mysql_connect($host, $user, $pw);
		   mysql_select_db($dbname);
		?>

		Top Locations:

		<div id="Map" style="width: 300px;"></div>

		<p>
		Query to run is:
		<?php 
		   echo $loc_query 
		?>
		</p>

		<p>
		<?php
		   $result = mysql_query($loc_query);
		   echo "Number of Rows returned: ".mysql_num_rows($result);
		   while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		     echo "<br/>";
		     foreach($row as $col) {
		       echo $col." | ";
		     }
		   }
		?>
		</p>
	</div>
</body>
</html>
