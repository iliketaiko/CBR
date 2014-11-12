<?php
$middle=array();
for($i=0;$i<9;$i++){
	$middle[$i] = $i+1;
	echo "middle[".$i."] = ".$middle[$i]."<br/>";
	}
echo "AVE=".array_sum($middle)/count($middle)."<br/>";
echo (count($middle)/2)."<br.>";
if(count($middle)%2 == 0){
	echo "middlenum = ".($middle[(count($middle)/2)-1]+$middle[(count($middle)/2)])/2;
	}else{
	echo "middlenum = ".$middle[count($middle)/2];
	}
?>