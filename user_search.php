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
                   $result = mysql_query(str_replace("USER_NAME", mysql_real_escape_string($_POST["search_string"]), $user_search_query));
		?>

                <?php 
                   $rows_found = mysql_num_rows($result);
                   if ($rows_found > 0) {
                     echo "Found ".$rows_found." users matching the search term: '".$_POST["search_string"]."'";
                     if ($rows_found > 50) {
                       echo " <br/>(only showing the first 50)";
                     }
                     echo "<br/>Click on one to get more information!";
                   } else {
                     echo "Could not find any users matching the search term: ".$_POST["search_string"];
                   }
                ?>
		<p>
		<?php
		   while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		     echo '<a href="user.php?username='.$row['github_username'].'">'.$row["github_username"]."</a><br/>";
		   }
		?>
		</p>
	</div>
</body>
</html>
