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
echo "<table border='1'><tr><td></td><td>職能分數</td><td>舊有員工平均</td><td></td><td>新應徵者平均</td><td></td><td>舊有員工中位數</td><td></td><td>新應徵者中位數</td><td></td></tr>";
	for($i=0;$i<$rownewmemberdata;$i++){
		echo "<tr><td colspan='10'>".($i+1)."</td></tr>";
		for($k=0;$k<4;$k++){
			$row_com = mysql_num_rows(mysql_query("SELECT * FROM  `competencycategorydata` WHERE  `Competencyposition` LIKE  '".$Comp."' AND  `ProjectF` LIKE  '".($k+1)."' ORDER BY  `competencycategorydata`.`ProjectS` ASC"));//抓取職能項目數量用
			for($j=0;$j<$row_com;$j++){
				//echo "<tr><td>".$j."</td></tr>";
				echo "<tr align='center'>";
				echo "<td>".($k+1)."-".($j+1)."</td>";
				echo "<td>".$arrayinception2[$i][$k][$j]."</td>";
				echo "<td>".$averagevalue[$k][$j]."</td>";
				if(($averagevalue[$k][$j]-$arrayinception2[$i][$k][$j])<0){
					echo "<td><font color='red'>".abs($averagevalue[$k][$j]-$arrayinception2[$i][$k][$j])."</font></td>";
				}else if(($averagevalue[$k][$j]-$arrayinception2[$i][$k][$j])>0){
					echo "<td><font color='green'>".abs($averagevalue[$k][$j]-$arrayinception2[$i][$k][$j])."</font></td>";
				}else{
					echo "<td>".($averagevalue[$k][$j]-$arrayinception2[$i][$k][$j])."</td>";
				}
				
				echo "<td>".$averagevalue2[$k][$j]."</td>";
				if(($averagevalue2[$k][$j]-$arrayinception2[$i][$k][$j])<0){
					echo "<td><font color='red'>".abs($averagevalue[$k][$j]-$arrayinception2[$i][$k][$j])."</font></td>";
				}else if(($averagevalue2[$k][$j]-$arrayinception2[$i][$k][$j])>0){
					echo "<td><font color='green'>".abs($averagevalue[$k][$j]-$arrayinception2[$i][$k][$j])."</font></td>";
				}else{
					echo "<td>".($averagevalue2[$k][$j]-$arrayinception2[$i][$k][$j])."</td>";
				}
				
				echo "<td>".$middlenumvalue[$k][$j]."</td>";
				if(($middlenumvalue[$k][$j]-$arrayinception2[$i][$k][$j])<0){
					echo "<td><font color='red'>".abs($middlenumvalue[$k][$j]-$arrayinception2[$i][$k][$j])."</font></td>";
				}else if(($middlenumvalue[$k][$j]-$arrayinception2[$i][$k][$j])>0){
					echo "<td><font color='green'>".abs($middlenumvalue[$k][$j]-$arrayinception2[$i][$k][$j])."</font></td>";
				}
				else{
					echo "<td>".($middlenumvalue[$k][$j]-$arrayinception2[$i][$k][$j])."</td>";
				}
				echo "<td>".$middlenumvalue2[$k][$j]."</td>";
				if(($middlenumvalue2[$k][$j]-$arrayinception2[$i][$k][$j])<0){
					echo "<td><font color='red'>".abs($middlenumvalue2[$k][$j]-$arrayinception2[$i][$k][$j])."</font></td>";
				}else if(($middlenumvalue2[$k][$j]-$arrayinception2[$i][$k][$j])>0){
					echo "<td><font color='green'>".abs($middlenumvalue2[$k][$j]-$arrayinception2[$i][$k][$j])."</font></td>";
				}
				else{
					echo "<td>".($middlenumvalue2[$k][$j]-$arrayinception2[$i][$k][$j])."</td>";
				}
				
				echo "</tr>";
			}
		}
		echo "<tr align='center'><td></td><td></td><td>OM平均</td><td>OP</td><td>NM</td><td>NP</td><td>OM中位數</td><td>OP</td><td>NM</td><td>NP</td></tr>";
		echo "<tr align='center'><td></td><td></td>
							<td><font color='red'>".$averagevaluetotal_p[$i]."</font></td>
							<td><font color='green'>".$averagevaluetotal_m[$i]."</font></td>
							<td><font color='red'>".$averagevaluetotal2_p[$i]."</font></td>
							<td><font color='green'>".$averagevaluetotal2_m[$i]."</font></td>
							<td><font color='red'>".$middlenumvalue_p[$i]."</font></td>
							<td><font color='green'>".$middlenumvalue_m[$i]."</font></td>
							<td><font color='red'>".$middlenumvalue2_p[$i]."</font></td>
							<td><font color='green'>".$middlenumvalue2_m[$i]."</font></td></tr>";
	}
?>
</table>
<table border="1" bordercolor="red">
<tr>
<?php
$n=count($averagevaluetotal_m);
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
        if($averagevaluetotal_m[$j]<$averagevaluetotal_m[$i]) {
            $temp=$averagevaluetotal_m[$i];
			$temp2=$newmembername[$i];
            $averagevaluetotal_m[$i]=$averagevaluetotal_m[$j];
			$newmembername[$i]=$newmembername[$j];
            $averagevaluetotal_m[$j]=$temp;
			$newmembername[$j]=$temp2;
           }
        }
	echo "<td>".$averagevaluetotal_m[$i]."</td><td>".$newmembername[$i]."</td>";
   }
echo "<td>".$averagevaluetotal_m[$n-1]."</td><td>".$newmembername[$n-1]."</td>";
?>
</tr>
</table>
<p><input type="button" onClick="self.location.href='Management.php'" value="回上頁" /></p>

</body>
</html>
