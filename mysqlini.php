<?php

$inifile = "/home/husnahadi/mysql_settings.ini"; 
if (!$settings = parse_ini_file($inifile, TRUE)) throw new 
exception('Unable to open ' . $file . '.'); 

$host = $settings['database']['host']; 
$dbname = $settings['database']['dbname']; 
$user = $settings['database']['username']; 
$pw = $settings['database']['password'];

?>
