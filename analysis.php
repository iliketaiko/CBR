<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>職能評估系統</title>
<link href="style2.css" rel="stylesheet" type="text/css" />
</head>
<?php
include"head.php";
$Comp = $_GET["Comp"];
$ProjectF = $_GET["ProjectF"];
if($ProjectF == "")$ProjectF = 1;
$PFM = $ProjectF -1;
$result = mysql_query("SELECT * FROM  `competencycategorydata` WHERE  `Competencyposition` LIKE  '".$Comp."' AND  `ProjectF` LIKE  '".$ProjectF."' ORDER BY  `competencycategorydata`.`ProjectS` ASC");//抓取職能項目名稱
$rowsunmber = mysql_num_rows($result);//職能項目比數
$rocn = array();
for($j=0;$j<$rowsunmber;$j++){
	$competencycategoryname = mysql_fetch_array($result);
	$rocn[$j] = $competencycategoryname["Item"];
	}
$result2 = mysql_query("SELECT * FROM  `member` WHERE account ='".$_SESSION['account']."'");
$accountcontent = mysql_fetch_array($result2);
$result3 = mysql_query("SELECT * FROM  `newmemberdata` WHERE  `Competencycategory` LIKE  '".$Comp."'AND `memberid` LIKE  '".$accountcontent['ID']."'");
$existdata = mysql_fetch_array($result3);
?>
<body>
<table width="700" border="1" align="center">
	<tr>
    	<td colspan="4">Hi，<?php echo $accountcontent['name']."你正在做".$Comp."的職缺職能分析";?></td>
    </tr>
	<tr align="center">
    	<td width="25%"><?php echo "<a href='analysis.php?Comp=".$Comp."&ProjectF=1'>人格特質部分-能力</a>";?></td>
        <td width="25%"><?php echo "<a href='analysis.php?Comp=".$Comp."&ProjectF=2'>人格特質部分-工作風格</a>";?></td>
        <td width="25%"><?php echo "<a href='analysis.php?Comp=".$Comp."&ProjectF=3'>專業知識、技術</a>";?></td>
        <td width="25%"><?php echo "<a href='analysis.php?Comp=".$Comp."&ProjectF=4'>專業職能</a>";?></td>
	</tr>
</table>
<form name="form1" method="post" <?php echo "action='CBRanalysisdatajoin.php?Comp=".$Comp."&ProjectF=".$ProjectF."'" ?> >
<table width="700" border="1" align="center">
	<tr align="center">
    	<td width="51%">職能問項</td>
    	<td width="7%">非<br />常<br />精<br />通</td>
    	<td width="7%">經<br />通</td>
    	<td width="7%">稍<br />微<br />精<br />通</td>
    	<td width="7%">普<br />通</td>
    	<td width="7%">不<br />太<br />善<br />長</td>
    	<td width="7%">不<br />善<br />長</td>
    	<td width="7%">非<br />常<br />不<br />善<br />長</td>
	</tr>
	<tr>
    	<td colspan="8" align="center"><font color="#669966">
<?php
    switch($ProjectF){
	case 1:
  	echo "人格特質-能力";
	$strex = str_split($existdata["D1"]);
 	break;
	case 2:
  	echo "人格特質-工作風格";
	$strex = str_split($existdata["D2"]);
	break;
	case 3:
	echo "專業知識、技術-特定產業相關的技能，通用於其產業職缺上。";
	$strex = str_split($existdata["D3"]);
	break;
	case 4:
  	echo "專業職能-特定產業的相關專業知識，只適用該相關職缺上。";
	$strex = str_split($existdata["D4"]);
}
?>
		</font></td>
	</tr>
<?php
	for($j=1;$j<=$rowsunmber;$j++){
	echo "<tr><td>".$ProjectF."-".$j."　".$rocn[$j-1]."</td>";
		for($i=7;$i>0;$i--){
			if($i == $strex[$j-1]){
			echo "<td align='center'><input type='radio' name='".$ProjectF."_".$j."' value=".$i." checked></td>";
			}else if($strex[$j-1]==0){
			echo "<td align='center'><input type='radio' name='".$ProjectF."_".$j."' value=".$i."></td>";
			}else{
			echo "<td align='center'><input type='radio' name='".$ProjectF."_".$j."' value=".$i."></td>";
			}
		}
	echo "</tr>";
	}

?>
	<tr>
    	<td colspan="8" align="right"><input name="Submit" type="submit" id="Submit" value="確認寫入"><input name="Cancel" type="reset" id="reset" vale="清除重填"></td>
    </tr>
</table>
<p align="center"><input type="button" value="回上頁" onclick="self.location.href='systemhome.php'"/></p>
<input name="name" type="hidden" value="<?php  echo $accountcontent['name'];?>">
</form>
</body>
</html>
