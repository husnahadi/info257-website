<html>
<body>

<?php
	include 'queriesini.php';
	include 'mysqlini.php';
	$queries = array("Users"=>$user_query, "Proj"=>$proj_query, "Orgs"=>$org_query);
?>

Your selection is: <?php echo $_POST["top10"]; 
$query_result = $queries[$_POST["top10"]];
?>
<p>
Query to run is:
<?php echo $query_result ?>
<p>
<?php
	if($result = $db->query($query_result)){ 
		echo $result->num_rows; 
		while($row = $result->fetch-array()){ 
			echo $row[‘Name’]; 
		} 
		$result->free();
	}


?>



</body>
</html>
