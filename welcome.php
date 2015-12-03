<html>
<head>
	<link rel="stylesheet" href="assets/styles/index.css" />
</head>
<body>

<?php
   include 'queriesini.php';
   include 'mysqlini.php';
   $queries = array("Users"=>$user_query, "Proj"=>$proj_query, "Orgs"=>$org_query);
   mysql_connect($host, $user, $pw);
   mysql_select_db($dbname);
?>

Your selection is: <?php echo $_POST["top10"]; ?>

<p>
Query to run is:
<?php 
   $query_result = $queries[$_POST["top10"]];
   echo $query_result 
?>
</p>

<p>
<?php
   $result = mysql_query($query_result);
   echo "Number of Rows returned: ".mysql_num_rows($result);
   while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
     echo "<br/>";
     foreach($row as $col) {
       echo $col." | ";
     }
   }
?>
</p>

</body>
</html>
