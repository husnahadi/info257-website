<?php

$inifile = "/home/erikkrogen/mysql_settings.ini"; #change to location of your password file
if (!$settings = parse_ini_file($inifile, TRUE)) throw new 
exception('Unable to open ' . $file . '.'); 

$host = $settings['database']['host']; 
$dbname = $settings['database']['dbname']; 
$user = $settings['database']['username']; 
$pw = $settings['database']['password'];

?>
