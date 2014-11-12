<?php
  include"head.php";
  
  $id = $_GET["id"];

  
  $result1 = mysql_query("SELECT * FROM  `competencycategory` WHERE  `ID` =".$id, $connect);
  mysql_query("SET NAMES 'utf8'");
  $result = mysql_fetch_array($result1);
  
  echo $result["Display"];

  if ($result["Display"] == 0)
  {
  	$modify = "UPDATE  `cbrdatabase`.`competencycategory` SET  `Display` =  '1' WHERE  `competencycategory`.`ID` =".$id." LIMIT 1 ;";
  }else if($result["Display"] == 1){
	$modify = "UPDATE  `cbrdatabase`.`competencycategory` SET  `Display` =  '0' WHERE  `competencycategory`.`ID` =".$id." LIMIT 1 ;";
  }
  mysql_query($modify);
  
  
	$url = "addcompetencyposition.php";
	echo "<script>";
	echo "location.href = \"$url\";";
 	echo "</script>";
?>
