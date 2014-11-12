<?php
$dbserver = "127.0.0.1";
$connect = mysql_connect($dbserver, "root", "2adiirxl") or die("Connection fail");
mysql_select_db("cbrdatabase", $connect);
mysql_query("SET NAMES UTF8"); 
?>
