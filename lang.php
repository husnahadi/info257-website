<html>
<head>
	<link rel="stylesheet" href="assets/styles/index.css" />
        <script src="Chart.js"></script>
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

                   isset($_POST["lang_name"]) ? $lang_name = $_POST["lang_name"] : $lang_name = $_GET["lang_name"];
                   $result = mysql_query(str_replace("LANG_NAME", mysql_real_escape_string($lang_name), $lang_query));                 
		?>
                <p>
                  For <?php echo $lang_name; ?>, total bytes of code contributed to all projects started in 
                  each year: 
                <p>
                <?php
                   $rows_found = mysql_num_rows($result);
                   if ($rows_found > 0) {
                     $lang = mysql_fetch_array($result, MYSQL_ASSOC);
                     function getBytes($lang2, $year) {
                       if ($lang2[$year.""] == NULL) {
                         return "0";
                       } else {
                         return $lang2[$year];
                       }
                     }
                     echo '<canvas id="myChart" width="400" height="400"></canvas>';
                   } else {
                     echo "Could not find any information for language: ".$lang_name;
                   }
                ?>

                <script>
                  // Get the context of the canvas element we want to select
                  var ctx = document.getElementById("myChart").getContext("2d");
                  var data = {
                    labels: ["Before 2010", "2010", "2011", "2012", "2013", "2014"],
                    datasets: [
                     {
                      label: "Language",
                      fillColor: "rgba(220,220,220,0.5)",
                      strokeColor: "rgba(220,220,220,0.8)",
                      highlightFill: "rgba(220,220,220,0.75)",
                      highlightStroke: "rgba(220,220,220,1)",
                      data: [<?php echo getBytes($lang,'bytes_pre_2010').','.getBytes($lang,'bytes_2010').','.getBytes($lang,'bytes_2011').','.getBytes($lang,'bytes_2012').','.getBytes($lang,'bytes_2013').','.getBytes($lang,'bytes_2014'); ?>]
                     }
                    ]
                  };
                  var myNewChart = new Chart(ctx).Bar(data);
                </script>
	</div>
</body>
</html>
