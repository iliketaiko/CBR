<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CBR職能分析系統</title>
<link href="style2.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div align="center"> 
<form action="registering.php" method="post" name="nmsform" id="nmsform" >
<table border="1" cellpadding="0" cellspacing="1" bordercolor="#D0EF7E">
	<tr>
		<td colspan="2" align="center">---------- 使用者帳號資料 ----------</td>
	</tr>
	<tr>
    	<td width="23%" valign="center" align="right"><font color="#FF0000">*</font>帳號：</td>
		<td width="77%" align="left"><input name="account"  type="text"  size="32" maxlength="30" ></td>
    </tr>
	<tr>
      <td width="23%" align="right" valign="baseline"><font color="#FF0000">*</font>密碼：</td>
      <td width="77%" align="left"><input name="password"  type="password"  size="32" maxlength="30" ></td>
    </tr>
	<tr>
		<td colspan="2" align="center">---------- 會員基本資料 ----------</td>
	</tr>
	<tr>
      <td width="23%" align="right" valign="baseline"><font color="#FF0000">*</font>姓名：</td>
      <td width="77%" align="left"><input name="fullname" id="fullname" type="text"  size="32" maxlength="30" ></td>
    </tr>
    <tr>
	    <td align="right" valign="baseline">公司名稱：</td>
	    <td align="left"> <input type="text"  name="industry"></td>  
	</tr>
    <tr>
	    <td align="right" valign="baseline">連絡電話：</td>
	    <td align="left"> <input type="text"  name="phone"></td>  
	</tr>
	 <tr>
      <td align="right" valign="baseline"><font color="#FF0000">*</font>電子信箱：</td>
      <td align="left"><input name="eMail" type="text" id="eMail"  size="50" maxlength="200" value=""></td>
    </tr>
		<tr>
      <td align="right" valign="baseline"><font color="#FF0000">*</font>教育程度：</td>
      <td align="left"><select name="degree"></option><option value='junior'>國中含以下</option>
      											<option value='senior'>高中職</option><option value='undergraduate'>大學(專)</option><option value='graduate'>研究所以上</option></select></td>
    </tr>	
	<tr>      
      <td colspan="2" align="center"><input name="Submit" type="submit" id="Submit" value="確定資料"><input type="button" onclick="cancel()" value="重新填寫"></td>
    </tr>
    <tr>
		<td colspan="2" align="center"><input type="button" onClick="javascript:history.back(1)" value="回上頁" /></td>
    </tr>
  </table>
</form>
</div>
</body>
</html>
