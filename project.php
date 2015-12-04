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

                   isset($_POST["project_name"]) ? $project_name = $_POST["project_name"] : $project_name = $_GET["project_name"];

                   $result = mysql_query(str_replace("PROJECT_NAME", $project_name, $proj_info_query));
		?>
                <p>
                <?php
                   $rows_found = mysql_num_rows($result);
                   if ($rows_found > 0) {
                     $proj = mysql_fetch_array($result, MYSQL_ASSOC);                    
                     foreach ($proj as $col) {
                       echo $col." | ";
                     } 
                   } else {
                     echo "Could not find any project with name: ".$_POST["project_name"];
                   }
                ?>
	</div>
</body>
</html>
