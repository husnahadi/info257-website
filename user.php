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

                   isset($_POST["username"]) ? $username = $_POST["username"] : $username = $_GET["username"];

                   $result = mysql_query(str_replace("USER_NAME", mysql_real_escape_string($username), $user_info_query));
		?>
                <p>
                <?php
                   $rows_found = mysql_num_rows($result);
                   if ($rows_found > 0) {
                     $user = mysql_fetch_array($result, MYSQL_ASSOC);

                     $project_result = mysql_query("SELECT project.name FROM project JOIN project_contributor USING (proj_id) WHERE project_contributor.user_id = ".$user['user_id'].";");
                     $org_result = mysql_query("SELECT organization.name FROM organization JOIN organization_contributor USING (org_id) WHERE organization_contributor.user_id = ".$user['user_id'].";");

                     echo '<p>GitHub Username: <a href="http://github.com/'.$user['github_username'].'/">'.$user['github_username']."</a>";
                     echo '<p>Name: '.$user['name'];
                     if ($user['location'] != NULL) {
                       echo '<p>Location: '.$user['location'];
                     }
                     if ($user['company'] != NULL) {
                       echo '<p>Company: '.$user['company'];
                     }
                     echo '<p>Projects contributed to by this user:';
                     echo '<ul>';
                     while ($proj_row = mysql_fetch_array($project_result, MYSQL_ASSOC)) {
                       echo '<li><a href="project.php?project_name='.$proj_row['name'].'">'.$proj_row['name'].'</a></li>';
                     }
                     echo '</ul>';
                     if (mysql_num_rows($org_result) > 0) {
                       echo '<p>Organizations contributed to by this user:';
                       echo '<ul>';
                       while ($org_row = mysql_fetch_array($org_result, MYSQL_ASSOC)) {
                         echo '<li><a href="org.php?org_name='.$org_row['name'].'">'.$org_row['name'].'</a></li>';
                       }
                       echo '</ul>';
                     }
                   } else {
                     echo "Could not find any contributor with username: ".$_POST["username"];
                   }
                ?>
	</div>
</body>
</html>
