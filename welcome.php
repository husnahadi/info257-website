<html>
<head>
	<link rel="stylesheet" href="assets/styles/index.css" />
</head>
<body>

<?php
	include 'queriesini.php';
	include 'mysqlini.php';
	$db = new mysqli($host, $user, $pw, $dbname);
	$queries = array("Users"=>$user_query, "Proj"=>$proj_query, "Orgs"=>$org_query);
?>

Your selection is: <?php echo $_POST["top10"]; ?>

<p>
Query to run is:
<?php 
	$query_result = $queries[$_POST["top10"]];
	echo $query_result 
?>

<p>
<?php
	if($db->connect_errorno){
		echo "<p>";
		echo "Connection failed!";
	}else{
		echo "<p>";
		echo "Connected!";
		if($result = $db->query($query_result)){ 
			echo $result->num_rows; 
			while($row = $result->fetch-array()){ 
				echo $row[‘Name’]; 
			} 
			$result->free();
		}
	}






?>



</body>
</html>
