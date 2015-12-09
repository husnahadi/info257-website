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

                   $year = $_POST["year"];
                   $result = mysql_query(str_replace("YEAR", mysql_real_escape_string($year), $lang_by_year_query));
		?>
                <p>
                  For projects started in the year <?php echo $year; ?>, total bytes of code contributed to
                  those projects:
                <p>
                <?php
                   $rows_found = mysql_num_rows($result);
                   if ($rows_found > 0) {
                     echo "<table><tr><th>Language</th><th>Bytes of Code</th></tr>";
                     while ($lang_row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                       echo '<tr><td><a href="lang.php?lang_name='.urlencode($lang_row['name']).'">'.$lang_row['name'].'</a></td><td>'.$lang_row['bytes'].'</td></tr>';
                     }
                     echo "</table>";
                   } else {
                     echo "Could not find any information for year: ".$year;
                   }
                ?>
	</div>
</body>
</html>
