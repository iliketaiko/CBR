<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>增加新職位</title>
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
$competency = mysql_fetch_array(mysql_query("SELECT * FROM  `competencycategory` WHERE  `Competencyposition` LIKE  '".$Comp."'"));
$competencyweight = str_split($competency["Weight"]);
?>
<body>
<div align="center"> 
<form action="modifyweight.php" method="post" name="nmsform" id="nmsform" >
<table  border="1" cellpadding="0" cellspacing="1" bordercolor="#CC6600" width="600">
<input type="hidden" name="Comp" value="<?php echo $Comp;?>">
	<tr>
		<td colspan="4" align="center">---------- 職務名稱 ----------</td>
	</tr>
	<tr>
    	<td width="23%" valign="center" align="right"><font color="#FF0000">*</font>職務名稱：</td>
		<td width="77%" align="center" colspan="3"><p><?php echo $Comp;?></p></td>
    </tr>
	<tr align="center">
    	<td width="25%"><?php echo "<a href='addcompetencydata.php?Comp=".$Comp."&ProjectF=1'>人格特質<br />能力</a>";?></td>
        <td width="25%"><?php echo "<a href='addcompetencydata.php?Comp=".$Comp."&ProjectF=2'>人格特質<br />工作風格</a>";?></td>
        <td width="25%"><?php echo "<a href='addcompetencydata.php?Comp=".$Comp."&ProjectF=3'>專業知識、技術</a>";?></td>
        <td width="25%"><?php echo "<a href='addcompetencydata.php?Comp=".$Comp."&ProjectF=4'>專業職能</a>";?></td>
	</tr>
	<tr align="center">
    	<?php
		for($i=1;$i<=4;$i++){
			echo "<td width='25%'><select name='compweight".$i."'>";
			for($j=1;$j<=4;$j++){
				if($competencyweight[($i-1)] == $j){
					echo "<option value=".$j." selected>".$j."</option>";
				}else{
					echo "<option value=".$j.">".$j."</option>";
				}
			}
			echo "</select></td>";
		}?>
	</tr>
	<tr>      
    	<td colspan="4" align="center"><input name="Submit" type="submit" id="Submit" value="確定修改"><input type="button" onclick="cancel()" value="重新填寫"></td>
    </tr>
</table>
</form>
<form action="addcd.php" method="post" name="nmsform" id="nmsform" >
<input type="hidden" name="Comp" value="<?php echo $Comp;?>">
<input type="hidden" name="ProjectF" value="<?php echo $ProjectF;?>">
<input type="hidden" name="ProjectS" value="<?php echo $rowsunmber+1;?>">
<table  border="1" cellpadding="0" cellspacing="1" bordercolor="#CC6600" width="600">
	<tr>
    	<td width="23%" align="right" colspan="2"><font color="#FF0000">*</font>職能項目名稱：</td>
    	<td width="77%" align="left" colspan="2"><input name="competencyitem" id="competencyitem" type="text"  size="32" maxlength="60" ></td>
    </tr>
    <tr>
	    <td align="right" colspan="2">內容敘述：</td>
	    <td align="left" colspan="2"><input name="competencycontent" id="competencycontent" type="text"  size="40"></td>  
	</tr>	
	<tr>      
    	<td colspan="4" align="center"><input name="Submit" type="submit" id="Submit" value="確定資料"><input type="button" onclick="cancel()" value="重新填寫"></td>
    </tr>
    <tr>      
    	<td colspan="4" align="center"><?php echo "<a href='addcompetencyposition.php'>點我回上頁</a>"; ?></td>
	</tr>
</table>
</form>
<table border="1" bordercolor="#0066CC">
<?php
	for($j=1;$j<=$rowsunmber;$j++){
	$competencydata = mysql_fetch_array($result);
	echo "<tr><td>".$competencydata["ProjectF"]."-".$competencydata["ProjectS"]."　<a href='competencydatamodify.php?Compdata=".$competencydata["ID"]."'>".$competencydata["Item"]."</a></td><td>".$competencydata["Content"]."</td></tr>";
	}
?>
</table>
</div>
</body>
</html>
