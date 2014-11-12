<?php
  include"head.php";
  
  $Comp = $_POST["Comp"];
  $ProjectF = $_POST["ProjectF"];
  $ProjectS = $_POST["ProjectS"];
  $competencyitem = $_POST["competencyitem"];
  $competencycontent = $_POST["competencycontent"];
  
  if($competencyitem == null){
		echo "<script>	alert ('Item is empty!');";
		echo "history.go(-1)";
		echo "</script>";
  
  }else{
  
	$result = mysql_query("SELECT * FROM  `competencycategorydata` WHERE  `Competencyposition` LIKE  '".$Comp."' AND  `Item` LIKE  '".$competencyitem."'", $connect);
	mysql_query("SET NAMES 'utf8'");

	if (mysql_num_rows($result) > 0)
	{
		echo "<script>	alert ('Data Already!');";
		echo "history.go(-1)";
		echo "</script>";
	}else{
	$addNew = "INSERT INTO  `cbrdatabase`.`competencycategorydata` (`ID` ,`Competencyposition` ,`ProjectF` ,`ProjectS` ,`Item` ,`Content`)VALUES (NULL ,  '$Comp',  '$ProjectF',  '$ProjectS',  '$competencyitem',  '$competencycontent');";
	mysql_query($addNew);
		$url = "addcompetencydata.php?Comp=".$Comp."&ProjectF=".$ProjectF;
		echo "<script>";
		echo "location.href = \"$url\";";
		echo "</script>";
	}
}
?>
