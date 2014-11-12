<?php
include"head.php";
include"CBR_fetch.php";
?>
<table border="1" align="center">
<?php
for($k=0;$k<4;$k++){
	$row_com = mysql_num_rows(mysql_query("SELECT * FROM  `competencycategorydata` WHERE  `Competencyposition` LIKE  '".$Comp."' AND  `ProjectF` LIKE  '".($k+1)."' ORDER BY  `competencycategorydata`.`ProjectS` ASC"));//抓取職能項目數量用
	for($j=0;$j<$row_com;$j++){
	echo "<tr align='center'>";
	echo "<td>".($k+1)."-".($j+1)."</td>";
	echo "<td>".$averagevalue[$k][$j]."</td>";
	echo "<td>".$averagevalue2[$k][$j]."</td>";
	echo "<td>".$middlenumvalue[$k][$j]."</td>";
	echo "<td>".$middlenumvalue2[$k][$j]."</td>";
	echo "</tr>";
	}
}
?>
</table>
