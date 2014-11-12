<?php
  include"head.php";
  
  $account = $_POST["account"];
  $password = $_POST["password"]; 
  $fullname = $_POST["fullname"];
  $industry = $_POST["industry"];
  $phone = $_POST["phone"];
  $email = $_POST["eMail"];
  $degree = $_POST["degree"];

  $result = mysql_query("select * from member WHERE account='".$account."'", $connect);
  mysql_query("SET NAMES 'utf8'");
  
  if (mysql_num_rows($result) > 0)
  {
  	 echo "<script>	alert ('這個帳號已經被使用了喔，請重新輸入一個!');";
	 echo "history.go(-1)";
	 echo "</script>";
  }else{
  $addNew = "INSERT INTO `member` (`ID`, `Account`, `Password`, `Name`, `Companyname`, `Phone`, `Mail`, `Degree`) VALUES (NULL , '$account', '$password', '$fullname', '$industry', '$phone', '$email', '$degree')";
  mysql_query($addNew);
  session_start();
	  echo "<script>	alert ('Register Succeed!');	</script>";
	  if (!isset($_SESSION['account'])) 
	  {
	  	$_SESSION['account'] = $account;
	  }
	  echo "<script>";
	  echo "location.href = \"systemhome.php\";";
 	  echo "</script>";
}
?>
