<html>
<head>
	<link rel="stylesheet" href="assets/styles/index.css" />
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
                   $result = mysql_query(str_replace("PROJECT_NAME", mysql_real_escape_string($_POST["search_string"]), $proj_search_query));
		?>

                <?php 
                   $rows_found = mysql_num_rows($result);
                   if ($rows_found > 0) {
                     echo "Found ".$rows_found." projects matching the search term: '".$_POST["search_string"]."'";
                     if ($rows_found > 50) {
                       echo " <br/>(only showing the first 50)";
                     }
                     echo "<br/>Click on one to get more information!";
                   } else {
                     echo "Could not find any projects matching the search term: ".$_POST["search_string"];
                   }
                ?>
		<p>
		<?php
		   while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		     echo '<a href="project.php?project_name='.$row['name'].'">'.$row["name"]."</a><br/>";
		   }
		?>
		</p>
	</div>
</body>
</html>
