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
		   mysql_connect($host, $user, $pw);
		   mysql_select_db($dbname);

                   isset($_POST["org_name"]) ? $org_name = $_POST["org_name"] : $org_name = $_GET["org_name"];

                   $result = mysql_query(str_replace("ORG_NAME", mysql_real_escape_string($org_name), $org_info_query));
		?>
                <p>
                <?php
                   $rows_found = mysql_num_rows($result);
                   if ($rows_found > 0) {
                     $org = mysql_fetch_array($result, MYSQL_ASSOC);

                     $project_result = mysql_query("SELECT project.name FROM project WHERE project.org_owner_id = ".$org['org_id'].";");
                     $user_result = mysql_query("SELECT contributor.github_username AS name FROM contributor JOIN organization_contributor USING (user_id) WHERE organization_contributor.org_id = ".$org['org_id'].";");
                
                     echo "<p>Organization: ".$org['name'];
                     if (mysql_num_rows($project_result) > 0) {
                       echo '<p>Projects owned by this organization: ';
                       echo '<ul>';
                       while ($proj_row = mysql_fetch_array($project_result, MYSQL_ASSOC)) {
                         echo '<li><a href="project.php?project_name='.$proj_row['name'].'">'.$proj_row['name'].'</a></li>';
                       }
                       echo '</ul>';
                     }

                     if (mysql_num_rows($user_result) > 0) {
                       echo '<p>Users who have contributed to this organization: ';
                       echo '<ul>';
                       while ($user_row = mysql_fetch_array($user_result, MYSQL_ASSOC)) {
                         echo '<li><a href="user.php?username='.$user_row['name'].'">'.$user_row['name'].'</a></li>';
                       }
                       echo '</ul>';
                     }

                   } else {
                     echo "Could not find any organization with name: ".$_POST["org_name"];
                   }
                ?>
	</div>
</body>
</html>
