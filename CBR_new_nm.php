<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>個人分析結果</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<link href="style2.css" rel="stylesheet" type="text/css" />
</head>
<?php
//這程式已經進化到我看不懂的境界了   2014/7/12 凌晨  亂寫一通了  給我畢業就好QQ
include"head.php";
include"CBR_fetch.php";
$id = $_GET["id"];
$memberid = $_GET["id"];
if($_SESSION['account'] == "manager"){
	$personalcompetencydata=mysql_query("SELECT * FROM  `newmemberdata` WHERE `ID` =".$id);
	$colspannum = 7;
}else{
	$personalcompetencydata=mysql_query("SELECT * FROM  `newmemberdata` WHERE  `Competencycategory` LIKE  '".$Comp."' AND  `memberid` =".$memberid);//抓取新進求職者個人資料
	$colspannum = 5;
}
$newmemberdata = array();
$personalcompetencydatacontent = mysql_fetch_array($personalcompetencydata);
$personalcompetency = mysql_num_rows($personalcompetencydata);
/*
將資料存入距陣，等著透過projectF值來調用要比對的資料將其丟進模組裡面跑圖
如要比的是D1(能力)，projectF值會是1，而當調用newmemberdata是會是用(projectF-1)當參數丟入
*/
$newmemberdata_h = str_split($personalcompetencydatacontent[$ProjectF+2]);//--看能不能有更好的寫法 -_- 這有點蠢
$newmemberdata[0] = str_split($personalcompetencydatacontent["D1"]);//--看能不能有更好的寫法 -_- 這有點蠢
$newmemberdata[1] = str_split($personalcompetencydatacontent["D2"]);//--看能不能有更好的寫法 -_- 這有點蠢
$newmemberdata[2] = str_split($personalcompetencydatacontent["D3"]);//--看能不能有更好的寫法 -_- 這有點蠢
$newmemberdata[3] = str_split($personalcompetencydatacontent["D4"]);//--看能不能有更好的寫法 -_- 這有點蠢
?>
<?
/*
要注意雖然projectF應當有五種值，但今天只是要判斷要畫哪張圖的話
其實只要判斷是否為0就可以了，如果是就用綜合評比的圖，不是就用其它單一能力的圖
至於裡面要填的距陣就透過projectF加減值就可以調出，如要看的是"能力"這項，projectF這項就會是1
*/
if($ProjectF != 0){
	$row_com = mysql_num_rows(mysql_query("SELECT * FROM  `competencycategorydata` WHERE  `Competencyposition` LIKE  '".$Comp."' AND  `ProjectF` LIKE  '".$ProjectF."' ORDER BY  `competencycategorydata`.`ProjectS` ASC"));//抓取職能項目數量用
	for($j=0;$j<$row_com;$j++){
		$avervalue = 0;		//舊員工的平均值
		$avervalue2 = 0;	//新員工的平均值
		for($i=0;$i<$rowseniormemberdata;$i++){
		/*
		arrayinception要看CBR_fetch.php
		arrayinception[成員編號][哪一類能力值(D1,D2..)][該能力值中的第幾項的值(6666755557)]
		*/
			$avervalue += $arrayinception[$i][($ProjectF-1)][$j];
			$middlenum[($ProjectF-1)][$i] = $arrayinception[$i][($ProjectF-1)][$j];	//並不是這裡就產出中位數，看下面
		}
		//arrayinception2是新員工的
		for($i=0;$i<$rownewmemberdata;$i++){
			$avervalue2 += $arrayinception2[$i][($ProjectF-1)][$j];
			$middlenum2[($ProjectF-1)][$i] = $arrayinception2[$i][($ProjectF-1)][$j];
		}
		sort($middlenum[($ProjectF-1)]);	
		$averagevalue[($ProjectF-1)][$j] = number_format(($avervalue/$rowseniormemberdata),2);//平均數
		sort($middlenum2[($ProjectF-1)]);
		$averagevalue2[($ProjectF-1)][$j] = number_format(($avervalue2/$rownewmemberdata),2);//平均數
		if(($rowseniormemberdata%2)==0){
			$middlenumvalue[($ProjectF-1)][$j]=(($middlenum[($ProjectF-1)][($rowseniormemberdata/2-1)]+$middlenum[($ProjectF-1)][($rowseniormemberdata/2)])/2);//中位數
			}else{
			$middlenumvalue[($ProjectF-1)][$j]=$middlenum[($ProjectF-1)][$rowseniormemberdata/2];
		}
		if(($rownewmemberdata%2)==0){
			$middlenumvalue2[($ProjectF-1)][$j]=(($middlenum2[($ProjectF-1)][($rownewmemberdata/2-1)]+$middlenum2[($ProjectF-1)][($rownewmemberdata/2)])/2);//中位數
			}else{
			$middlenumvalue2[($ProjectF-1)][$j]=$middlenum2[($ProjectF-1)][$rownewmemberdata/2];
		}
	}
}else{
$personalscore;
$tempps;
	for($k=0;$k<4;$k++){
		for($j=0;$j<count($newmemberdata[$k]);$j++){
		$personalscore[$k] += $newmemberdata[$k][$j];
		}
		$personalscore[$k] = number_format(($personalscore[$k]/(count($newmemberdata[$k])*7)*100),2);
	}
	

$totalcompetencyweight = $competencyweight[0]+$competencyweight[1]+$competencyweight[2]+$competencyweight[3];

function weightcalculate($a,$b,$c,$d){
	$tcw = $a*1/8+$b*1/8+$c*2/8+$d*4/8;	//看起來是個偷吃歩，這裡把權重寫死了，我一定能修好它//好像不用修了，後面採用要使用時直接計算不透過function的方式了，這function很可能並沒有被用到
	//$tcw = ($a*$competencyweight[0]/$totalcompetencyweight)+($b*$competencyweight[0]/$totalcompetencyweight)+($c*$competencyweight[0]/$totalcompetencyweight)+($d*$competencyweight[0]/$totalcompetencyweight);
	return $tcw;
}
}
?>
<script type="text/javascript">
<?php if($ProjectF != 0){?>
$(function () {
        $('#container').highcharts({
            title: {
                text: '<?php echo $ProjectName;?>',
                x: -20 //center
            },
            subtitle: {
                text: '<?php echo $Comp;?>',
                x: -20
            },
            xAxis: {
                categories: [<?for($j=0;$j<($rowcompetencycategorydata-1);$j++){
				echo "'".$rocn[$j]."',";
				}
				echo "'".$rocn[($rowcompetencycategorydata-1)]."'";
				?>]
            },
            yAxis: {
                title: {
                    text: '職能分數'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: ''
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: '<?php echo $personalcompetencydatacontent["Name"];?>',
                data: [<?php
				for ($k=0;$k<(count($newmemberdata_h)-1);$k++){
					echo $newmemberdata_h[$k].",";
					}
					echo $newmemberdata_h[$k];
				?>]
            }, <?php if($_SESSION['account'] == "manager"){?>{
                name: '現有職員職能平均數',
                data: [<?php
				for ($k=0;$k<(count($averagevalue[($ProjectF-1)])-1);$k++){
					echo $averagevalue[($ProjectF-1)][$k].",";
					}
					echo $averagevalue[($ProjectF-1)][$k];?>]
            }, {
                name: '現有職員職能中位數',
                data: [<?php
				for ($k=0;$k<(count($middlenumvalue[($ProjectF-1)])-1);$k++){
					echo $middlenumvalue[($ProjectF-1)][$k].",";
					}
					echo $middlenumvalue[($ProjectF-1)][$k];
				?>]
            }, <?php } ?>{
                name: '新進求職者職能平均數',
                data: [<?php
				for ($k=0;$k<(count($averagevalue2[($ProjectF-1)])-1);$k++){
					echo $averagevalue2[($ProjectF-1)][$k].",";
					}
					echo $averagevalue2[($ProjectF-1)][$k];?>]
            }, {
                name: '新進求職者職能中位數',
                data: [<?php
				for ($k=0;$k<(count($middlenumvalue2[($ProjectF-1)])-1);$k++){
					echo $middlenumvalue2[($ProjectF-1)][$k].",";
					}
					echo $middlenumvalue2[($ProjectF-1)][$k];
				?>]
            }]
        });
    });
<?php }else if($ProjectF == 0){ ?>
$(function () {

	$('#container').highcharts({
	            
	    chart: {
	        polar: true,
	        type: 'line'
	    },
	    
	    title: {
	        text: '個人分析結果',
	        x: -80
	    },
	    
	    pane: {
	    	size: '80%'
	    },
	    
	    xAxis: {
	        categories: ['綜合評比','人格特質部分-能力','人格特質部分-工作風格','專業知識、技術','專業領域'],
	        tickmarkPlacement: 'on',
	        lineWidth: 0
	    },
	        
	    yAxis: {
	        gridLineInterpolation: 'polygon',
	        lineWidth: 0,
	        min: 0
	    },
	    
	    tooltip: {
	    	shared: true,
	        pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.0f}</b><br/>'
	    },
	    
	    legend: {
	        align: 'right',
	        verticalAlign: 'top',
	        y: 70,
	        layout: 'vertical'
	    },
	    
	    series: [{
	        name: '<?php echo $personalcompetencydatacontent["Name"];?>',
	        data: [<?php $tempscore;
						for($z=0;$z<4;$z++)$tempscore += ($personalscore[$z]*$competencyweight[$z]/$totalcompetencyweight);
						echo"$tempscore, $personalscore[0], $personalscore[1], $personalscore[2], $personalscore[3]";?>],
	        pointPlacement: 'on'
	    }, {
	        name: '舊有員工綜合分數',
	        data: [<?php $tempscore1;
						for($z=0;$z<4;$z++)$tempscore1 += ($score[$z]*$competencyweight[$z]/$totalcompetencyweight);			
						echo "$tempscore1, $score[0], $score[1], $score[2], $score[3]";?>],
			pointPlacement: 'on'
	    }, {
	        name: '新進求職者綜合分數',
	        data: [<?php $tempscore2;
						for($z=0;$z<4;$z++)$tempscore2 += ($score2[$z]*$competencyweight[$z]/$totalcompetencyweight);			
						echo "$tempscore2, $score2[0], $score2[1], $score2[2], $score2[3]";?>],
	        pointPlacement: 'on'
	    }]
	
	});
});
<?php } ?>
</script>
</br>
<body>
<script src="js/highcharts.js"></script>
<?php if($ProjectF == 0)echo"<script src='js/highcharts-more.js'></script>";?>
<script src="js/modules/exporting.js"></script>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<div id="web" align="center">
<?php	//看是要看哪個項目比較，決定你的projectF值
	echo "[<a href='CBR_new_nm.php?id=".$id."&Comp=".$Comp."&ProjectF=0'>綜合評比</a>]";
	echo "[<a href='CBR_new_nm.php?id=".$id."&Comp=".$Comp."&ProjectF=1'>人格特質部分-能力</a>]";
	echo "[<a href='CBR_new_nm.php?id=".$id."&Comp=".$Comp."&ProjectF=2'>人格特質部分-工作風格</a>]";
	echo "[<a href='CBR_new_nm.php?id=".$id."&Comp=".$Comp."&ProjectF=3'>專業知識、技術</a>]";
	echo "[<a href='CBR_new_nm.php?id=".$id."&Comp=".$Comp."&ProjectF=4'>專業領域</a>]";
?>
<?php if($ProjectF != 0){?>
<table border="1">
	<tr>
<?php echo"<td align='center' colspan='".$colspannum."'><font size='+3'>".$Comp."</font></td>" ?>
    </tr>
	<tr align="center">
		<td></td>
		<td>職能項目名稱</td>
		<td>新求職者職能</td>
<?php
if($_SESSION['account'] == "manager"){
	echo "<td>現有職員職能平均數</td>";
	echo "<td>現有職員職中位數</td>";
	}
?>
		<td>新進求職者職能平均數</td>
		<td>新進求職者職能中位數</td>
	</tr>
<?php //新進求職者資料
for($j=0;$j<$rowcompetencycategorydata;$j++){
	echo "<tr align='center'>";
	echo "<td aling='left'>".$ProjectF."-".($j+1)."</td>";
	echo "<td>".$rocn[$j]."</td>";
	echo "<td>".$newmemberdata_h[$j]."</td>";
	if($_SESSION['account'] == "manager"){
	echo "<td>".$averagevalue[($ProjectF-1)][$j]."</td>";//現有職員職能平均數
	echo "<td>".$middlenumvalue[($ProjectF-1)][$j]."</td>";//現有職員職中位數
	}
	echo "<td>".$averagevalue2[($ProjectF-1)][$j]."</td>";
	echo "<td>".$middlenumvalue2[($ProjectF-1)][$j]."</td>";
	echo "</tr>";
	}
?>
</table>
<?php }else{ ?>
<table border="1" bordercolor="red">
<tr>
	<td><font size="+2">綜合評比分數</font></td>
	<td><font size="+2"><?php echo $tempscore;?></font></td>
</tr>
</table>
<table border="1" bordercolor="Gray">
<tr align="center"><td>人格特質部分<br/>-能力</td><td>人格特質部分<br/>-工作風格</td><td>專業知識、技術</td><td>專業領域</td></tr>
<?php
echo "<tr align='center'>";
	for($a=0;$a<4;$a++){
		echo "<td width='150'>".$personalscore[$a]."</td>";
	}
echo "</tr>";
?>
<tr>
</table>
<?php }?>

</div>
</body>
</html>
