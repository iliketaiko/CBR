<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改職能資料</title>
<link href="style2.css" rel="stylesheet" type="text/css" />
</head>
<?php
include"head.php";
$id = $_GET["Compdata"];
$result = mysql_query("SELECT * FROM  `competencycategorydata` WHERE  `ID` =".$id);//
$row = mysql_fetch_array($result);//
?>
<body>
<form action="modifycd.php" method="post" name="nmsform" id="nmsform" ><!-- 修改職能資料 -->
<input type="hidden" name="id" value="<?php echo $id;?>">
<table  border="1" cellpadding="0" cellspacing="1" bordercolor="#CC6600" width="600">
	<tr>
		<td colspan="2" align="center">修改職能資料</td>
	</tr>
	<tr>
    	<td width="35%" valign="center" align="right">職缺名稱：</td>
		<td width="65%" align="left"><?php echo $row["Competencyposition"];?></td>
    </tr>
	<tr>
    	<td width="35%" valign="center" align="right"></td>
		<td width="65%" align="left"><?php echo $row["ProjectF"]."-".$row["ProjectS"];?></td>
    </tr>
	<tr>
    	<td width="35%" align="right"><font color="#FF0000">*</font>職能項目名稱：</td>
    	<td width="65%" align="left"><input name="competencyitem" id="competencyitem" type="text"  size="32" maxlength="60" value="<?php echo $row["Item"]?>";></td>
    </tr>
    <tr>
	    <td align="right">內容敘述：</td>
	    <td align="left"><input name="competencycontent" id="competencycontent" type="text"  size="60" value="<?php echo $row["Content"]?>";></td>  
	</tr>
	<tr>
		<td colspan="2" align="right"><input name="Submit" type="submit" id="Submit" value="確認修改"><input name="Cancel" type="reset" id="reset" vale="清除重填"></td>
    </tr>
</table>
</body>
</html>