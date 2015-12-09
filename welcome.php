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
		   $queries = array("Users"=>$top_user_query, "Projects"=>$top_proj_query, "Organizations"=>$top_org_query);
                   $titles = array("Users"=>"Number of Projects", "Projects"=>"Bytes of Code", "Organizations"=>"Bytes of Code");
                   $descriptions = array("Users"=>"the highest number of projects contributed to", 
					 "Projects"=>"the size of the project, in bytes of code", 
					 "Organizations"=>"highest total number of bytes of code owned by that organization");
                   $selection = $_POST["top10"];
                   mysql_connect($host, $user, $pw);
		   mysql_select_db($dbname);
                   $result = mysql_query($queries[$selection]);
		?>

		<p>
		Top 10 <?php echo $selection ?> as judged by <?php echo $descriptions[$selection] ?>
		</p>
		<table>
		<tr><th>Name</th><th><?php echo $titles[$selection] ?></th></tr>
		<?php
		   while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		     echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td></tr>";
		   }
		?>
		</table>
	</div>
</body>
</html>
