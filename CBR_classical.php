<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>分析結果</title>
</head>
<?php
include"head.php";
$result=mysql_query("SELECT * FROM  `seniormemberdata` WHERE  `Competencycategory` LIKE  'RiskManage'");
$rowsunmber = mysql_num_rows($result);
$a1=array();
$b1=array();
$c1=array();
$d1=array();
$e1=array();
$f1=array();
$g1=array();
$h1=array();
$i1=array();
$j1=array();//建十個空Array塞舊有資料
$arrayinception=array($a1,$b1,$c1,$d1,$e1,$f1,$g1,$h1,$i1,$j1);
/*for($i=0;$i<$rowsunmber;$i++)
{
	$row = mysql_fetch_array($result);
	for($j=0;$j<4;$j++){
	$arrayinception[$i][0] = str_split($row["D1"]);
	$arrayinception[$i][1] = str_split($row["D2"]);
	$arrayinception[$i][2] = str_split($row["D3"]);
	$arrayinception[$i][3] = str_split($row["D4"]);
}
echo $arrayinception[0][3][0];
echo $arrayinception[1][3][0];*/

$d4_1=$_POST["w4_1"];
$d4_2=$_POST["w4_2"];
$d4_3=$_POST["w4_3"];
$d4_4=$_POST["w4_4"];
$d4_5=$_POST["w4_5"];
$d4_6=$_POST["w4_6"];
$d4_7=$_POST["w4_7"];
$d4_8=$_POST["w4_8"];
$d4_9=$_POST["w4_9"];
$d4_10=$_POST["w4_10"];
$d4_11=$_POST["w4_11"];
$d4_12=$_POST["w4_12"];
$d4_13=$_POST["w4_13"];
$d4_14=$_POST["w4_14"];
$d4_15=$_POST["w4_15"];
$arrayd4=array($d4_1,$d4_2,$d4_3,$d4_4,$d4_5,$d4_6,$d4_7,$d4_8,$d4_9,$d4_10,$d4_11,$d4_12,$d4_13,$d4_14,$d4_15);

$totaldis=array();
?>
</br>
<body>

<table width="700" border="1" align="center">
<?php
	echo "<tr> <td>組別</td>";
	for($i=0;$i<15;$i++){
		$div=$i+1;
    	echo "<td>4-".$div."</td>";
	}
    echo "</tr>"
?>
<?php //隨機十組資料當作歷史資料
	for($i=0;$i<10;$i++){
		$div = $i+1;
		echo "<tr> <td>第".$div."組</td>";
		$dis_t = 0;
		for($j=0;$j<15;$j++){
			$a=rand(3,7);
			$arrayinception[$j][$i] = $a;
			echo "<td>".$arrayinception[$j][$i]."</td>";
			$arrayinception[$j][$i] = abs($arrayd4[$j]-$arrayinception[$j][$i]);//將距離替代到原本隨機十組裡的值
			$dis_t += $arrayinception[$j][$i];
			}
		$totaldis[$i] = $dis_t;//把總距離值寫進去totaldis陣列裡面
		echo "</tr>";
		}
?>
    <tr>
        <td colspan="16">分隔線</td>
    </tr>
<?php
	echo "<tr> <td>此組</td>";
	for($i=0;$i<15;$i++){
    	echo "<td>".$arrayd4[$i]."</td>";
	}
    echo "</tr>"
?>
    <tr>
        <td colspan="16">分隔線</td>
    </tr>  
<?php 
	for($i=0;$i<10;$i++){
		$div = $i+1;
		echo "<tr> <td>第".$div."組".$totaldis[$i]."</td>";
		for($j=0;$j<15;$j++){
			echo "<td>".$arrayinception[$j][$i]."</td>";
		}
	echo "</tr>";
	}
?>
</table>
</body>
</html>
