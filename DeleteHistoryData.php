<?php
include"head.php";
$id = $_POST["ID"];

$del = "DELETE FROM `tempmemberdata` WHERE `tempomemberdata`.`ID` =".$id.";";

mysql_query("SET NAMES 'utf8'");

mysql_query($del);


echo "<script>";
echo "location.href = \"CBR_new.php\";";
echo "</script>";

?>