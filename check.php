<?php session_start();
    include"head.php";

  	$name = mysql_query("select Account from member", $connect);
	$pass = mysql_query("select Password from member", $connect);
  	$total = mysql_num_rows($name);
  	$account = $_POST["account"];
	$password = $_POST["password"];
	$unlogin = 0;
	
  	  mysql_data_seek($name, 0);
   	  for ($x = 0; $x < $total; $x++){
	  	 $OneName[$x] = mysql_fetch_array($name);
		 $OnePass[$x] = mysql_fetch_array($pass);
		 if ($account == $OneName[$x][0] && $password == $OnePass[$x][0])
		 {
		   if (!isset($_SESSION['account'])) 
			{
	  		$_SESSION['account'] = $account;
			}
			if($account == "manager"){
				echo "<script>	location.href = \"management.php\";  </script>";
			}else{
				echo "<script>	location.href = \"systemhome.php\";  </script>";
			}
		 }else{
		 	$unlogin++;
		 }
	 }	
	 if ($unlogin == $total)
	 {
	    echo "<script>	alert ('±b¸¹©Î±K½X¦³¿ù»~!');	</script>";
	 	echo "<script>	location.href = \"member.php\";  </script>";
	 }
  	mysql_free_result($name);
	mysql_free_result($pass);
  	mysql_close($connect);
?>