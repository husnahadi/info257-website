<?php

$inifile = "queries.ini"; 
if (!$queries = parse_ini_file($inifile, TRUE)) throw new 
exception('Unable to open ' . $file . '.'); 

$top_user_query = $queries['queries']['users'];  
$top_proj_query = $queries['queries']['projs'];  
$top_org_query = $queries['queries']['orgs']; 
$loc_query = $queries['queries']['user_locations'];
$proj_search_query = $queries['queries']['project_search'];
$proj_info_query = $queries['queries']['project'];
$user_search_query = $queries['queries']['user_search'];
$user_info_query = $queries['queries']['user'];
$org_search_query = $queries['queries']['org_search'];
$org_info_query = $queries['queries']['org'];
$lang_by_year_query = $queries['queries']['lang_by_year'];
$lang_query = $queries['queries']['lang'];

?>
