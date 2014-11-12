<?php
	include"head.php";
	$Comp = $_POST["Comp"];
	$compweight1 = $_POST["compweight1"];
	$compweight2 = $_POST["compweight2"];
	$compweight3 = $_POST["compweight3"];
	$compweight4 = $_POST["compweight4"];
	$compweight = $compweight1.$compweight2.$compweight3.$compweight4;

	$result = mysql_query("UPDATE  `cbrdatabase`.`competencycategory` SET  `Weight` =  '".$compweight."' WHERE  `Competencyposition` LIKE  '".$Comp."'", $connect);
	mysql_query("SET NAMES 'utf8'");
	mysql_query($result);

	
	$url = "addcompetencydata.php?Comp=".$Comp;
	echo "<script>";
	echo "location.href = \"$url\";";
	echo "</script>";
?>
