<html>
<body>

<?php
$cars = array("Volvo", "BMW", "Toyota");
$ages = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
$queries = array("Users"=>"Users Query", "Proj"=>"Projects Query", "Orgs"=>"Organizations Query");

?>

Your selection is: <?php echo $_POST["top10option"]; 
$query_result = $queries[$_POST["top10option"]];
?>
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
