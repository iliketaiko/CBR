<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style2.css" rel="stylesheet" type="text/css" />
<title>增加新職位</title>
</head>
<?php
include"head.php";	//SQL相關參數 
$result=mysql_query("SELECT * FROM  `competencycategory` ORDER BY  `competencycategory`.`Competencyposition` ASC ");//抓取現有職缺資料
$rowsunmber = mysql_num_rows($result);	//回傳行數, 只對SELECT有效
?>
<body>
<div align="center"> 	<!--區塊居中對齊--> 
<form action="addcp.php" method="post" name="nmsform" id="nmsform" ><!-- 增加新職位,提交表單至addcp.php -->
<table  border="1" cellpadding="0" cellspacing="1" bordercolor="#CC6600" width="600">
	<tr>
		<td colspan="4" align="center">---------- 職務名稱 ----------</td>
	</tr>
	<tr>
    	<td width="25%" valign="center" align="right"><font color="#FF0000">*</font>職務名稱：</td>
		<td width="75%" align="left" colspan="3"><input name="positionname"  type="text"  size="32" maxlength="30" ></td>
    </tr>
	<tr>
    	<td width="25%" valign="center" align="right"><font color="#FF0000">*</font>註解：</td>
		<td width="75%" align="left" colspan="3"><input name="content"  type="text"  size="32" maxlength="30" ></td>
    </tr>
	<tr>
    	<td width="25%" valign="center" align="right"><font color="#FF0000">*</font>錄取分數：</td>
		<td width="75%" align="left" colspan="3"><input name="score"  type="text"  size="32" maxlength="30" ></td>
    </tr>
	<tr align="center">
		<td width="25%">人格特質能力</td>
        <td width="25%">人格特質工作風格</td>
        <td width="25%">專業知識</td>
        <td width="25%">專業職能</td>
    </tr>
	<tr align="center">
		<td width="25%">權重</td>
        <td width="25%">權重</td>
        <td width="25%">權重</td>
        <td width="25%">權重</td>
    </tr>
	<tr align="center"><?php
		for($i=1;$i<=4;$i++){
			echo "<td width='25%'><select name='compweight".$i."'>";
			for($j=1;$j<=4;$j++){
				echo "<option value=".$j.">".$j."</option>";
			}
			echo "</select></td>";
		}?>
    
	<tr>
	
	
		<td colspan="4" align="center"><input name="Submit" type="submit" id="Submit" value="確認新增"><input name="Cancel" type="reset" id="reset" vale="清除重填"></td>
    </tr>
</table>
<table border="1" cellpadding="0" cellspacing="1" bordercolor="#CC6600" width="500">
    <tr>
		<td align="center" width="85%">---------- 現有職務 ----------</td>
		<td align="center" width="15%">發佈與否</td>
	</tr>
<?php
for($i=0;$i<$rowsunmber;$i++){
	$row = mysql_fetch_array($result);
	echo "<tr><td align='center'><font size='+1'><a href='addcompetencydata.php?Comp=".$row["Competencyposition"]."'><p>".$row["Competencyposition"]."</p></a></font></td>";
	if($row["Display"] == 0){
	echo "<td align='center'><a href='discompetencydata.php?id=".$row["ID"]."'>X</a></td></tr>";
	}else{
	echo "<td align='center'><a href='discompetencydata.php?id=".$row["ID"]."'>O</a></td></tr>";
	}
	}
?>
	<tr>      
    	<td colspan="2" align="center"><font color="#00AA00">點選上列各新增職缺進入職能項目編輯頁面<br/ >編輯完記得點選發佈頁面</font></td>
	</tr>
	<tr>      
    	<td colspan="2" align="center"><a href="Management.php">點我回上頁</a></td>
	</tr>
</table>
</form>
</div>
</body>
</html>
