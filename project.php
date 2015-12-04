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

                   $result = mysql_query(str_replace("PROJECT_NAME", mysql_real_escape_string($project_name), $proj_info_query));
		?>
                <p>
                <?php
                   $rows_found = mysql_num_rows($result);
                   if ($rows_found > 0) {
                     $proj = mysql_fetch_array($result, MYSQL_ASSOC);

                     $lic_result = mysql_query("SELECT * FROM license WHERE license_id = ".$proj['license_id'].";");
                     $lic_row = mysql_fetch_array($lic_result, MYSQL_ASSOC);

                     if ($proj['org_owner_id'] != NULL) {
                       $owner_result = mysql_query('SELECT * FROM organization WHERE org_id = "'.$proj['org_owner_id'].'";');
                       $owner_row = mysql_fetch_array($owner_result, MYSQL_ASSOC);
                       $owner_name = $owner_row['name'];
                     } else {
                       $owner_result = mysql_query('SELECT * FROM contributor WHERE user_id = "'.$proj['user_owner_id'].'";');
                       $owner_row = mysql_fetch_array($owner_result, MYSQL_ASSOC);
                       $owner_name = $owner_row['github_username'];
                     }

                     echo '<p>Project: <a href="http://github.com/'.$owner_name.'/'.$proj['name'].'/">'.$proj['name']."</a>";
                     echo "<p>Date project was started: ".$proj['start_date'];
                     echo "<p>Number of people watching this project: ".$proj['watchers_count'];
                     echo "<p>Number of times this project has been forked: ".$proj['fork_count'];
                     echo '<p>Type of license used: <a href="http://choosealicense.com/licenses/'.$lic_row['short_name'].'">'.$lic_row['full_name']."</a>";
                     echo '<p>Owner of the project: <a href="http://github.com/'.$owner_name.'/">'.$owner_name."</a>";
                   } else {
                     echo "Could not find any project with name: ".$_POST["project_name"];
                   }
                ?>
	</div>
</body>
</html>
