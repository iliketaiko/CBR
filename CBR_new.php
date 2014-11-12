<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>分析結果</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<link href="style2.css" rel="stylesheet" type="text/css" />
</head>
<?php
include"head.php";
include"CBR_fetch.php";
?>
<?
if($ProjectF != 0){
	for($i=0;$i<$rownewmemberdata;$i++){
	$averagevaluetotal_m[$i] = 0;
	$middlenumvalue_m[$i] = 0;
		$row_com = mysql_num_rows(mysql_query("SELECT * FROM  `competencycategorydata` WHERE  `Competencyposition` LIKE  '".$Comp."' AND  `ProjectF` LIKE  '".$ProjectF."' ORDER BY  `competencycategorydata`.`ProjectS` ASC"));//抓取職能項目數量用
		for($j=0;$j<$row_com;$j++){
			if(($arrayinception2[$i][($ProjectF-1)][$j]-$averagevalue[($ProjectF-1)][$j])>0){
				$averagevaluetotal_p[$i] += (abs($arrayinception2[$i][($ProjectF-1)][$j]-$averagevalue[($ProjectF-1)][$j]));
			}else if(($arrayinception2[$i][($ProjectF-1)][$j]-$averagevalue[($ProjectF-1)][$j])<0){
				$averagevaluetotal_m[$i] += (abs($arrayinception2[$i][($ProjectF-1)][$j]-$averagevalue[($ProjectF-1)][$j]));
			}
			
			if(($arrayinception2[$i][($ProjectF-1)][$j]-$averagevalue2[($ProjectF-1)][$j])>0){
				$averagevaluetotal2_p[$i] += (abs($arrayinception2[$i][($ProjectF-1)][$j]-$averagevalue2[($ProjectF-1)][$j]));
			}else if(($arrayinception2[$i][($ProjectF-1)][$j]-$averagevalue2[($ProjectF-1)][$j])<0){
				$averagevaluetotal2_m[$i] += (abs($arrayinception2[$i][($ProjectF-1)][$j]-$averagevalue2[($ProjectF-1)][$j]));
			}
			
			if(($arrayinception2[$i][($ProjectF-1)][$j]-$middlenumvalue[($ProjectF-1)][$j])>0){
				$middlenumvalue_p[$i] += (abs($arrayinception2[$i][($ProjectF-1)][$j]-$middlenumvalue[($ProjectF-1)][$j]));
			}else if(($arrayinception2[$i][($ProjectF-1)][$j]-$middlenumvalue[($ProjectF-1)][$j])<0){
				$middlenumvalue_m[$i] += (abs($arrayinception2[$i][($ProjectF-1)][$j]-$middlenumvalue[($ProjectF-1)][$j]));
			}
			
			if(($arrayinception2[$i][($ProjectF-1)][$j]-$middlenumvalue2[($ProjectF-1)][$j])>0){
				$middlenumvalue2_p[$i] += (abs($arrayinception2[$i][($ProjectF-1)][$j]-$middlenumvalue2[($ProjectF-1)][$j]));
			}else if(($arrayinception2[$i][($ProjectF-1)][$j]-$middlenumvalue2[($ProjectF-1)][$j])<0){
				$middlenumvalue2_m[$i] += (abs($arrayinception2[$i][($ProjectF-1)][$j]-$middlenumvalue2[($ProjectF-1)][$j]));
			}		
		}
	}
}
?>
<style type="text/css">
${demo.css}
</style>
<script type="text/javascript">

$(function () {
        $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: '<?php echo $ProjectName;?>'
            },
            subtitle: {
                text: 'Source: CBR_SyStam.com'
            },
            xAxis: {
                categories: [<?php 
				for($i=0;$i<($rownewmemberdata-1);$i++){
				echo "'".$newmembername[$i]."',";
				}echo "'".$newmembername[$rownewmemberdata-1]."'";
				?>]
            },
            yAxis: {
                min: 0,
                title: {
                    text: '職能分數'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: '平均數',
                data: [<?php 
				for($i=0;$i<($rownewmemberdata-1);$i++){
				echo $averagevaluetotal_m[$i].",";
				}echo $averagevaluetotal_m[$rownewmemberdata-1];
				?>]
    
            }, {
                name: '中位數',
                data: [<?php 
				for($i=0;$i<($rownewmemberdata-1);$i++){
				echo $middlenumvalue_m[$i].",";
				}echo $middlenumvalue_m[$rownewmemberdata-1];
				?>]
    
            }]
        });
    });
    

		</script>

<body>
<script src="js/highcharts.js"></script>
<script src="js/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<?php
	echo "[<a href='CBR_new.php?Comp=".$Comp."&ProjectF=0'>綜合評比</a>]";
	echo "[<a href='CBR_new.php?Comp=".$Comp."&ProjectF=1'>人格特質部分-能力</a>]";
	echo "[<a href='CBR_new.php?Comp=".$Comp."&ProjectF=2'>人格特質部分-工作風格</a>]";
	echo "[<a href='CBR_new.php?Comp=".$Comp."&ProjectF=3'>專業知識、技術</a>]";
	echo "[<a href='CBR_new.php?Comp=".$Comp."&ProjectF=4'>專業領域</a>]";
?>

<table border="1" bordercolor="red">
<tr>
<?php
$n=$rownewmemberdata;
for($i=0;$i<$n-1;$i++){
	echo "<td colspan='2' align='center'>".($i+1)."</td><td rowspan='2'>&nbsp;</td>";
	}
echo "<td colspan='2' align='center'>".($i+1)."</td>";
?>
</tr>
<tr>
<?php

	for($i=0;$i<$n-1;$i++){
		for($j=$i+1;$j<$n;$j++) {
			if($middlenumvalue_m[$j]<$middlenumvalue_m[$i]) {
				$temp=$middlenumvalue_m[$i];
				$temp2=$newmembername[$i];
				$temp3=$newmemberid[$i];
				$middlenumvalue_m[$i]=$middlenumvalue_m[$j];
				$newmembername[$i]=$newmembername[$j];
				$newmemberid[$i]=$newmemberid[$j];
				$middlenumvalue_m[$j]=$temp;
				$newmembername[$j]=$temp2;
				$newmemberid[$j]=$temp3;
			}
        }
	echo "<td>".$middlenumvalue_m[$i]."</td><td><a href='CBR_new_nm.php?id=".$newmemberid[$i]."&Comp=".$Comp."&ProjectF=".$ProjectF."' target='_blank'>".$newmembername[$i]."</a></td>";
   }
	echo "<td>".$middlenumvalue_m[$n-1]."</td><td><a href='CBR_new_nm.php?id=".$newmemberid[$i]."&Comp=".$Comp."&ProjectF=".$ProjectF."' target='_blank'>".$newmembername[$n-1]."</a></td>";

?>
</tr>
</table>
<p><input type="button" onClick="self.location.href='Management.php'" value="回上頁" /></p>

</body>
</html>
