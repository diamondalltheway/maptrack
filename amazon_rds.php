<?php
$dbhost = 'mapkitchen.ccac4o1ben3l.us-west-2.rds.amazonaws.com:3306';
$dbuser = 'mapkitchen';
$dbpass = 'mapkitchen';

$conn = mysql_connect($dbhost, $dbuser, $dbpass);

mysql_select_db('mapkitchen');

?>