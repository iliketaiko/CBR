<?php
  include"head.php";
  
  $positionname = $_POST["positionname"];
  $content = $_POST["content"];
  $compweight1 = $_POST["compweight1"];
  $compweight2 = $_POST["compweight2"];
  $compweight3 = $_POST["compweight3"];
  $compweight4 = $_POST["compweight4"];
  $score = $_POST["score"];
  $compweight = $compweight1.$compweight2.$compweight3.$compweight4;

  $result = mysql_query("SELECT * FROM  `competencycategory` WHERE  `Competencyposition` LIKE '".$positionname."'", $connect);
  mysql_query("SET NAMES 'utf8'");


  if (mysql_num_rows($result) > 0)
  {
  	 echo "<script>	alert ('Position Already!');";
	 echo "history.go(-1)";
	 echo "</script>";
  }else{
  $addNew = "INSERT INTO  `cbrdatabase`.`competencycategory` (`ID` ,`Competencyposition` ,`Content`,`Weight`,`Display`,`Score`)VALUES (NULL ,  '$positionname',  '$content',  '$compweight',  '0', '$score');";
  mysql_query($addNew);
	  
	  echo "<script>";
	  echo "location.href = \"addcompetencyposition.php\";";
 	  echo "</script>";
}
?>
