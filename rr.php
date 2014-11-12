<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>CBR_system</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style2.css" rel="stylesheet" type="text/css" />
</head>

<?php
include"head.php";
$result = mysql_query("SELECT * FROM  `member` WHERE account ='".$_SESSION['account']."'");
$accountcontent = mysql_fetch_array($result);

$result2=mysql_query("SELECT * FROM  `competencycategory` ORDER BY  `competencycategory`.`Competencyposition` ASC ");//抓取現有職缺資料
$rowsunmber = mysql_num_rows($result2);
?>

<table border="1" bordercolor="#00F000">
<?php
	for($i=0;$i<$rowsunmber;$i++){
		$row = mysql_fetch_array($result2);
		echo "<tr>";
		echo "<td><a href='rrn.php?Comp=".$row["Competencyposition"]."'>點我隨機新增新進求職者</a></td>";
		echo "<td><a href='cleanmemberdata.php?md=newmemberdata'>點我清空新進求職者資料表</a></td>";
		echo "<td>".$row["Competencyposition"]."</td>";
		echo "<td><a href='rrs.php?Comp=".$row["Competencyposition"]."'>點我隨機新增舊有員工資料</a></td>";
		echo "<td><a href='cleanmemberdata.php?md=seniormemberdata'>點我清空舊有員工資料表</a></td>";
		echo "</tr>";
	}
?>
</table>
<p><input type="button" onClick="self.location.href='Management.php'" value="回上頁" /></p>
<!-- End Save for Web Slices -->
</body>
</html>