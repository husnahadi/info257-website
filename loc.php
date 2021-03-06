<html>
<head>
	<link rel="stylesheet" href="assets/styles/index.css" />
        <script src="Chart.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
	<script type="text/javascript">


	// var addresses = ['2499 Cedar Creek Street, Santa Rosa, CA', '4474 Poinsettia Court, San Jose, CA', 'Asia','North America','South America'];
	var addresses = ['London, UK', 'San Francisco, CA', 'Paris, France', 'Seattle, WA', 'Austin, TX', 'Berlin, Germany', 'Austin, TX', 'Germany', 'Russia', 'Tokyo, Japan', 'Australia'];	
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
		console.log("Adding marker!");
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
			<a href="index.html"><img class = "img_head" src="assets/img/logo.png"></a><br>
			<hr>
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

		<div class="query_title">Top Locations:</div>
		<p>
		<div id="Map" style="width: 500px; height: 329px;"></div>
		<div class="query_desc">Map of the top locations contributors have contributed from.</div>

                  <canvas id="myChart" width="400" height="400"></canvas>
		    <?php
		       $result = mysql_query($loc_query);
                       $contrib_amounts = array();
                       $contrib_locs = array();
		       while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                         array_push($contrib_locs, '"'.$row[0].'"');
                         array_push($contrib_amounts, $row[1]);
		       }
		    ?>               

                <script>
                  // Get the context of the canvas element we want to select
                  var ctx = document.getElementById("myChart").getContext("2d");
                  var data = {
                    labels: [<?php echo implode(",", $contrib_locs); ?>],
                    datasets: [
                     {
                      label: "Language",
                      fillColor: "rgba(220,220,220,0.5)",
                      strokeColor: "rgba(220,220,220,0.8)",
                      highlightFill: "rgba(220,220,220,0.75)",
                      highlightStroke: "rgba(220,220,220,1)",
                      data: [<?php echo implode(",", $contrib_amounts); ?>]
                     }
                    ]
                  };
                  var myNewChart = new Chart(ctx).Bar(data);
                </script>
	</div>

</body>
</html>
