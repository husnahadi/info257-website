<?php

$inifile = "queries.ini"; 
if (!$queries = parse_ini_file($inifile, TRUE)) throw new 
exception('Unable to open ' . $file . '.'); 

$user_query = $queries['queries']['users'];  

$proj_query = $queries['queries']['projs'];  

$org_query = $queries['queries']['orgs']; 


?>
