<?php
	include"head.php";
	$id = $_POST["id"];
	$competencyitem = $_POST["competencyitem"];
	$competencycontent = $_POST["competencycontent"];
  
	$result = mysql_query("SELECT * FROM  `competencycategorydata` WHERE  `ID` =".$id);
	$row = mysql_fetch_array($result);
  

	$modifycd = "UPDATE  `cbrdatabase`.`competencycategorydata` SET  `Item` =  '".$competencyitem."',`Content` =  '".$competencycontent."' WHERE  `competencycategorydata`.`ID` =".$id." ;";
	mysql_query("SET NAMES 'utf8'");
	mysql_query($modifycd);	
	
	$url = "addcompetencydata.php?Comp=".$row["Competencyposition"]."&ProjectF=".$row["ProjectF"];
	echo "<script>";
	echo "location.href = \"$url\";";
 	echo "</script>";

?>
