<?php
include"head.php";
$md = $_GET["md"];
mysql_query("TRUNCATE TABLE  `".$md."`");
mysql_query("SET NAMES 'utf8'");
$url = "rr.php";
echo "<script>alert ('Data has been write!');";
echo "location.href = \"$url\";";
echo "</script>";
?>
