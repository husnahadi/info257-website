<?php 
	echo "Hello!";
	include 'mysqlini.php';
	$db = new mysqli($host, $user, $pw, $dbname);
	echo "HELLO!!!!"
	echo $user_query;
	echo "GOODBYE!!"
	if($db->connect_errorno){
		echo "<p>";
		echo "Connection failed!";
	}else{
		echo "<p>";
		echo "Connected!";
		$query_result = "SELECT * FROM Users";
		if ($result = $db->query($query_noresult)){
			echo $result->num_rows;
		}else{
			echo "<p>DIDN'T WORK";
		}
	}	

?>
