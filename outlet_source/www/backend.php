<?php
header("Content-type: application/json");

$time = intval($_GET["time"]);
$channel = intval($_GET["channel"]);
$pid = intval($_GET["pid"]);
$op = intval($_GET["op"]);

$parameters="op:".$op.";time:".$time.";channel:".$channel.";pid:".$pid;

$exestr = 'none';
if($op==0){
	$exestr = 'sh gpio4light.sh '.$time.' '.$channel.' > /dev/null 2>&1 &';
	exec($exestr);
}
else if($op==1){
	$exestr = 'just list ps';
}
else if($op==2 && $pid > 0){
	$searchPs = shell_exec('ps axo pid,bsdstart,command | grep gpio | grep '.$pid.' | grep -v grep');
	if(empty($searchPs))
		$exestr = 'Do not find '.$pid;
	else{
		$exestr = 'sh killgpio.sh '.$pid.' >/dev/null 2>&1 &';
		exec($exestr);
	}
}
else if($op==3){
	$exestr = 'sudo reboot';
	exec($exestr);
}
else{
	$exestr = 'Unknow command';
}
$processListStr = shell_exec('ps axo pid,bsdstart,command | grep gpio | grep -v grep');
$arr = array('param' => $parameters, 'output' => $exestr,'ps'=> $processListStr);
echo json_encode($arr);
?>
