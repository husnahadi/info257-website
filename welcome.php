<html>
<head>
	<link rel="stylesheet" href="assets/styles/index.css" />
</head>
<body>
	<div class = "title_bg">
		<div class = "title_container">
			<a href="index.html"><img class = "img_head" src="assets/img/logo.png"></a>
			<div class="hr"><hr></div>
		</div>
	</div>
	<div class = "content">
		<?php
		   include 'queriesini.php';
		   include 'mysqlini.php';
		   $queries = array("Users"=>$user_query, "Projects"=>$proj_query, "Organizations"=>$org_query);
		   $titles = array("Users"=>"Number of Projects", "Projects"=>"Bytes of Code", "Organizations"=>"Bytes of Code");
			mysql_connect($host, $user, $pw);
		   mysql_select_db($dbname);
		?>

		Your selection is: <?php echo $_POST["top10"]; ?>

		<?php 
		   $query_result = $queries[$_POST["top10"]];
		?>
		</p>

		<p>
		<?php
			echo "<div class='query_title'>Name | "; 
			echo $titles[$_POST["top10"]];
			echo "</div>";
		   $result = mysql_query($query_result);
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
