<html>
<head>
	<link rel="stylesheet" href="assets/styles/index.css" />
</head>
<body>
	<div class = "title_bg">
		<div class = "title_container">
			<img class = "img_head" src="assets/img/logo.png">
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
