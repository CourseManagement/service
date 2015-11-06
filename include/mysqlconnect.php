<?php
$db_host = 'localhost';
$db_database = 'swgtest';
$db_username = 'root';
$db_password = 'mima_wyx';
$connection = mysql_connect($db_host,$db_username,$db_password);
mysql_select_db($db_database,$connection);
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");
?>