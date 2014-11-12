<?php
//這程式已經進化到我看不懂的境界了   2014/7/12 凌晨  亂寫一通了  給我畢業就好QQ
//整體用
$Comp = $_GET["Comp"];	//不要找在哪裡上傳至GET[]中的，這是直接寫進網址的資料(Management.php)
$ProjectF = $_GET["ProjectF"];	//如果沒搞錯看起來就是只會是0的樣子啊
if($ProjectF == null)$ProjectF = 1;
$ProjectName;
switch($ProjectF){	//幾乎預設為0，所以進來就是進入綜合評比畫面
case 0:
$ProjectName = "綜合評比";
break;
case 1:
$ProjectName = "人格特質部分-能力";
break;
case 2:
$ProjectName = "人格特質部分-工作風格";
break;
case 3:
$ProjectName = "專業知識、技術";
break;
case 4:
$ProjectName = "專業領域";
break;
}
$seniormemberdata=mysql_query("SELECT * FROM  `seniormemberdata` WHERE  `Competencycategory` LIKE  '".$Comp."'");//抓舊員工資料
$rowseniormemberdata = mysql_num_rows($seniormemberdata);
$arrayinception_seniormemberdata=array();
for($i=0;$i<$rowseniormemberdata;$i++)
{
	$row = mysql_fetch_array($seniormemberdata);

	$arrayinception[$i][0] = str_split($row["D1"]);
	$arrayinception[$i][1] = str_split($row["D2"]);
	$arrayinception[$i][2] = str_split($row["D3"]);
	$arrayinception[$i][3] = str_split($row["D4"]);
	/*
	arrayinception[成員編號][ProjectF][ProjectS];
	= arrayinception[成員編號][哪一類能力值][該能力值中的第幾項的值]
	*/
}
$newmemberdata=mysql_query("SELECT * FROM  `newmemberdata` WHERE  `Competencycategory` LIKE  '".$Comp."'");//抓新員工資料
$rownewmemberdata = mysql_num_rows($newmemberdata);
$arrayinception2=array();
for($i=0;$i<$rownewmemberdata;$i++)
{
	$newmember = mysql_fetch_array($newmemberdata);
	$newmemberid[$i] = $newmember["ID"];
	$newmembername[$i] = $newmember["Name"];
	$arrayinception2[$i][0] = str_split($newmember["D1"]);
	$arrayinception2[$i][1] = str_split($newmember["D2"]);
	$arrayinception2[$i][2] = str_split($newmember["D3"]);
	$arrayinception2[$i][3] = str_split($newmember["D4"]);//$arrayinception[成員編號][ProjectF][ProjectS];
}
$competencycategorydata = mysql_query("SELECT * FROM  `competencycategorydata` WHERE  `Competencyposition` LIKE  '".$Comp."' AND  `ProjectF` LIKE  '".$ProjectF."' ORDER BY  `competencycategorydata`.`ProjectS` ASC");//抓取職能項目名稱
$rowcompetencycategorydata = mysql_num_rows($competencycategorydata);//職能項目比數
$rocn = array();//
for($j=0;$j<$rowcompetencycategorydata;$j++){
	$competencycategoryname = mysql_fetch_array($competencycategorydata);
	$rocn[$j] = $competencycategoryname["Item"];
	}
	
$competency = mysql_fetch_array(mysql_query("SELECT * FROM  `competencycategory` WHERE  `Competencyposition` LIKE  '".$Comp."'"));
$competencyweight = str_split($competency["Weight"]);

$avervalue = int;
$averagevalue;
$middlenum;
$middlenumvalue;
$avervalue2 = int;
$averagevalue2;
$middlenum2;
$middlenumvalue2;
$score;
$score2;
for($k=0;$k<4;$k++){
	$row_com = mysql_num_rows(mysql_query("SELECT * FROM  `competencycategorydata` WHERE  `Competencyposition` LIKE  '".$Comp."' AND  `ProjectF` LIKE  '".($k+1)."' ORDER BY  `competencycategorydata`.`ProjectS` ASC"));//抓取職能項目數量用
	for($j=0;$j<$row_com;$j++){
		$avervalue = 0;
		$avervalue2 = 0;
		for($i=0;$i<$rowseniormemberdata;$i++){
			$avervalue += $arrayinception[$i][$k][$j];
			$middlenum[$k][$i] = $arrayinception[$i][$k][$j];
		}
		for($i=0;$i<$rownewmemberdata;$i++){
			$avervalue2 += $arrayinception2[$i][$k][$j];
			$middlenum2[$k][$i] = $arrayinception2[$i][$k][$j];
		}
		sort($middlenum[$k]);
		$averagevalue[$k][$j] = number_format(($avervalue/$rowseniormemberdata),2);//平均數
		sort($middlenum2[$k]);
		$averagevalue2[$k][$j] = number_format(($avervalue2/$rownewmemberdata),2);//平均數
		if(($rowseniormemberdata%2)==0){
			$middlenumvalue[$k][$j]=(($middlenum[$k][($rowseniormemberdata/2-1)]+$middlenum[$k][($rowseniormemberdata/2)])/2);//中位數
			}else{
			$middlenumvalue[$k][$j]=$middlenum[$k][$rowseniormemberdata/2];
		}
		if(($rownewmemberdata%2)==0){
			$middlenumvalue2[$k][$j]=(($middlenum2[$k][($rownewmemberdata/2-1)]+$middlenum2[$k][($rownewmemberdata/2)])/2);//中位數
			}else{
			$middlenumvalue2[$k][$j]=$middlenum2[$k][$rownewmemberdata/2];
		}
		$score[$k] += $avervalue;
		$score2[$k] += $avervalue2;
	}
	$score[$k] = number_format(($score[$k]/($row_com*7*$rowseniormemberdata)*100),1);
	$score2[$k] = number_format(($score2[$k]/($row_com*7*$rownewmemberdata)*100),1);
}

$averagevaluetotal_m;
$averagevaluetotal_p;//舊有員工
$averagevaluetotal2_m;
$averagevaluetotal2_p;//新進員工
$middlevaluetotal_m;
$middlevaluetotal_p;//舊有員工
$middlevaluetotal2_m;
$middlevaluetotal2_p;//新進員工
/*$ProjectFtotal;
$ProjectFtotal2;
$tem;
$tem2;*/
for($i=0;$i<$rownewmemberdata;$i++){
	for($k=0;$k<4;$k++){
		$row_com = mysql_num_rows(mysql_query("SELECT * FROM  `competencycategorydata` WHERE  `Competencyposition` LIKE  '".$Comp."' AND  `ProjectF` LIKE  '".($k+1)."' ORDER BY  `competencycategorydata`.`ProjectS` ASC"));//抓取職能項目數量用
		for($j=0;$j<$row_com;$j++){
			if(($arrayinception2[$i][$k][$j]-$averagevalue[$k][$j])>0){
				$averagevaluetotal_p[$i] += (abs($arrayinception2[$i][$k][$j]-$averagevalue[$k][$j]))/$competencyweight[$k];
			}else if(($arrayinception2[$i][$k][$j]-$averagevalue[$k][$j])<0){
				$averagevaluetotal_m[$i] += (abs($arrayinception2[$i][$k][$j]-$averagevalue[$k][$j]))/$competencyweight[$k];
			}
			
			if(($arrayinception2[$i][$k][$j]-$averagevalue2[$k][$j])>0){
				$averagevaluetotal2_p[$i] += (abs($arrayinception2[$i][$k][$j]-$averagevalue2[$k][$j]))/$competencyweight[$k];
			}else if(($arrayinception2[$i][$k][$j]-$averagevalue2[$k][$j])<0){
				$averagevaluetotal2_m[$i] += (abs($arrayinception2[$i][$k][$j]-$averagevalue2[$k][$j]))/$competencyweight[$k];
			}
			
			if(($arrayinception2[$i][$k][$j]-$middlenumvalue[$k][$j])>0){
				$middlenumvalue_p[$i] += (abs($arrayinception2[$i][$k][$j]-$middlenumvalue[$k][$j]))/$competencyweight[$k];
			}else if(($arrayinception2[$i][$k][$j]-$middlenumvalue[$k][$j])<0){
				$middlenumvalue_m[$i] += (abs($arrayinception2[$i][$k][$j]-$middlenumvalue[$k][$j]))/$competencyweight[$k];
			}
			
			if(($arrayinception2[$i][$k][$j]-$middlenumvalue2[$k][$j])>0){
				$middlenumvalue2_p[$i] += (abs($arrayinception2[$i][$k][$j]-$middlenumvalue2[$k][$j]))/$competencyweight[$k];
			}else if(($arrayinception2[$i][$k][$j]-$middlenumvalue2[$k][$j])<0){
				$middlenumvalue2_m[$i] += (abs($arrayinception2[$i][$k][$j]-$middlenumvalue2[$k][$j]))/$competencyweight[$k];
			}
		}
	}
}
?>
