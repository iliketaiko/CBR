<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>CBR_system</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<?php
include"head.php";
$result = mysql_query("SELECT * FROM  `member` WHERE account ='".$_SESSION['account']."'");
$accountcontent = mysql_fetch_array($result);
?>
<body bgcolor="#FFFFFF" style="leftmargin=0px; topmargin=0px; marginwidth=0px; marginheight=0px">
<!-- Save for Web Slices (modernisme_sliced.psd) -->
<table style="width=1001px; height=600px;" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
<tr>
		<td colspan="4"><div id="logo"><div><a href="index.php"><img src="images/mainlogo.png" alt="logo" width="103" height="62" border="0" style="float:left; padding-left:90px; padding-top: 30px; padding-right: 20px; " longdesc="index.php" /></a></div>
		<div class="company-name">CBR_Competency System<span class="content"><?PHP if(mysql_num_rows($result) > 0) echo "Hi,".$accountcontent["name"];?></span></div></div></td>
</tr>
<tr>
	<td rowspan="2" colspan="2"><div class="left_menu">
        <ul>
        <li><a href="index.php">Home</a></li>
        <li><?php if($_SESSION['account'] == manager){echo"<a href='management.php'>CBR_Manage</a>";}else{echo"<a href='systemhome.php'>CBR_system</a>";}?></li>
        <li><?php if($_SESSION['account'] == null){echo"<a href='member.php'>Login_Page</a>";}else{echo"<a href='logout.php'>Logout</a>";}?></li>
		<li><a href="aboutme.php">About Author</a></li>
        </ul></div></td>
	<td><div id="header"><div class="header">CCU_AIT</div>
		<div class="header-sub">YihanLiao<br />&amp; SOLUTIONS</div>
        </div></td>
</tr>
<tr>
	<td>
	<div id="content-main">
		<div class="title2">National Pineapple University</div>
		<div class="content"></div>
    </div>
	</td>
</tr>
</table>
<!-- End Save for Web Slices -->
</body>
</html>