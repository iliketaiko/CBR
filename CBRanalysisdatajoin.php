<?php
	session_start();
	include"head.php";
	$Comp = $_GET["Comp"];
	$ProjectF = $_GET["ProjectF"];
	$name = $_POST["name"];
	$url= "analysis.php?Comp=".$Comp."&ProjectF=".$ProjectF;

	$result = mysql_query("SELECT * FROM  `competencycategorydata` WHERE  `Competencyposition` LIKE  '".$Comp."' AND  `ProjectF` LIKE  '".$ProjectF."'");//抓取職能項目名稱
	$rowsunmber = mysql_num_rows($result);//職能項目比數
	$rocn = array();
	
	for($i=0;$i<$rowsunmber;$i++){
	$j= $i+1;
	$num = $_POST[$ProjectF."_".$j];
		if($num == 0){
			echo "<script>	alert ('Oops!Something You Missed!Checked again.');	</script>";
			echo "<script type='text/javascript'>";
			echo "window.location.href='$url'";
			echo "</script>"; 
		}
	$str_num = sprintf("%d",$num);//數字轉換字串
	$rocn[$i] = $str_num;
	}
	
	$str_competencyresult = implode("",$rocn);//字串結合
	
	
	
	$result2 = mysql_query("SELECT * FROM  `member` WHERE account ='".$_SESSION['account']."'");
	$accountcontent = mysql_fetch_array($result2);
	$iid = $accountcontent['ID'];
	
	$result3 = mysql_query("SELECT * FROM  `newmemberdata` WHERE  `Competencycategory` LIKE  '".$Comp."' AND `memberid` =".$iid);
	$r3id = mysql_fetch_array($result3);
	if(mysql_num_rows($result3) != 0){
		switch($ProjectF){
		case 1:
		$update = "UPDATE  `cbrdatabase`.`newmemberdata` SET  `D1` =  '$str_competencyresult' WHERE  `newmemberdata`.`ID` =".$r3id["ID"];
		break;
		case 2:
		$update = "UPDATE  `cbrdatabase`.`newmemberdata` SET  `D2` =  '$str_competencyresult' WHERE  `newmemberdata`.`ID` =".$r3id["ID"];
		break;
		case 3:
		$update = "UPDATE  `cbrdatabase`.`newmemberdata` SET  `D3` =  '$str_competencyresult' WHERE  `newmemberdata`.`ID` =".$r3id["ID"];
		break;
		case 4:
		$update = "UPDATE  `cbrdatabase`.`newmemberdata` SET  `D4` =  '$str_competencyresult' WHERE  `newmemberdata`.`ID` =".$r3id["ID"];
		break;
		}
	$iResult = mysql_query($update) or die("失敗");
	}else{
		switch($ProjectF){
		case 1:
		$addNew = "INSERT INTO `newmemberdata` (`ID`, `Competencycategory`, `Name`, `D1`,`memberid`) VALUES (NULL , '$Comp', '$name', '$str_competencyresult', '$iid');";
		break;
		case 2:
		$addNew = "INSERT INTO `newmemberdata` (`ID`, `Competencycategory`, `Name`, `D2`,`memberid`) VALUES (NULL , '$Comp', '$name', '$str_competencyresult', '$iid');";
		break;
		case 3:
		$addNew = "INSERT INTO `newmemberdata` (`ID`, `Competencycategory`, `Name`, `D3`,`memberid`) VALUES (NULL , '$Comp', '$name', '$str_competencyresult', '$iid');";
		break;
		case 4:
		$addNew = "INSERT INTO `newmemberdata` (`ID`, `Competencycategory`, `Name`, `D4`,`memberid`) VALUES (NULL , '$Comp', '$name', '$str_competencyresult', '$iid');";
		break;
		}
	$iResult = mysql_query($addNew) or die("失敗");
	}
	
	switch($ProjectF){
	case 1:
	$url = "analysis.php?Comp=".$Comp."&ProjectF=2";
	break;
	case 2:
	$url = "analysis.php?Comp=".$Comp."&ProjectF=3";
	break;
	case 3:
	$url = "analysis.php?Comp=".$Comp."&ProjectF=4";
	break;
	case 4:
	$url = "systemhome.php";
	}
	echo "<script type='text/javascript'>";
	echo "window.location.href='$url'";
	echo "</script>";
?>
