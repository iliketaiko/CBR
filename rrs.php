<?php
include"head.php";
$Comp = $_GET["Comp"];
$www = string;
$result = mysql_query("SELECT * FROM  `seniormemberdata` WHERE  `Competencycategory` LIKE  '$Comp'");
mysql_query("SET NAMES 'utf8'");

$fuk1 = mysql_query("SELECT * FROM  `competencycategorydata` WHERE  `Competencyposition` LIKE  '$Comp' AND  `ProjectF` LIKE  '1'");
$fuk2 = mysql_query("SELECT * FROM  `competencycategorydata` WHERE  `Competencyposition` LIKE  '$Comp' AND  `ProjectF` LIKE  '2'");
$fuk3 = mysql_query("SELECT * FROM  `competencycategorydata` WHERE  `Competencyposition` LIKE  '$Comp' AND  `ProjectF` LIKE  '3'");
$fuk4 = mysql_query("SELECT * FROM  `competencycategorydata` WHERE  `Competencyposition` LIKE  '$Comp' AND  `ProjectF` LIKE  '4'");

if (mysql_num_rows($result)<3){
	$wow=array();
	$rrwow = string;
	$crycry=array();
	for($s=0;$s<10;$s++){
		$rrwow = null;
		for($j=0;$j<mysql_num_rows($fuk1);$j++){
			$wow[0][$j] = rand(5,7);
			$rrwow = $rrwow.sprintf("%d",$wow[0][$j]);
		}
		$crycry[0] = $rrwow;
		echo $crycry[0]."<br />";
	
		$rrwow = null;
		for($j=0;$j<mysql_num_rows($fuk2);$j++){
			$wow[1][$j] = rand(5,7);
			$rrwow = $rrwow.sprintf("%d",$wow[1][$j]);
		}
		$crycry[1] = $rrwow;
		echo $crycry[1]."<br />";

	
		$rrwow = null;
		for($j=0;$j<mysql_num_rows($fuk3);$j++){
			$wow[2][$j] = rand(5,7);
			$rrwow = $rrwow.sprintf("%d",$wow[2][$j]);
		}
		$crycry[2] = $rrwow;
		echo $crycry[2]."<br />";


		$rrwow = null;
		for($j=0;$j<mysql_num_rows($fuk4);$j++){
			$wow[3][$j] = rand(5,7);
			$rrwow = $rrwow.sprintf("%d",$wow[3][$j]);
		}
		$crycry[3] = $rrwow;
		echo $crycry[3]."<br />";
		
		$www = "隨機帳號".($s+1);
		
		$addNew = "INSERT INTO `cbrdatabase`.`seniormemberdata` (`ID` ,`Competencycategory` ,`Name` ,`D1` ,`D2` ,`D3` ,`D4`)VALUES (NULL ,  '$Comp',  '$www',  '$crycry[0]',  '$crycry[1]',  '$crycry[2]',  '$crycry[3]');";
		mysql_query($addNew);
		
	}
}
	$url = "rr.php";
	echo "<script>alert ('Data has been write!');";
	echo "location.href = \"$url\";";
 	echo "</script>";
?>
