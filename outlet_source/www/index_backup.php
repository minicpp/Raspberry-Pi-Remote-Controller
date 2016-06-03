<html>
<head>
	<title>Dong Han's Fancy Home</title>
</head>
<body>
<script>
function DoSubmit(var_time){
	if(var_time >= 0)
		document.myform.time.value = var_time;
	document.myform.channel.value = 0;
}
function DoChannel(var_index){
	document.myform.channel.value = var_index;
}
</script>
<form action="" name="myform" method="post">
Password script:
<input type="text" name="run" value="I love Dandan Liu."/>
<br />
Delay(seconds):
<input type="text" name="time" value="<?=$_POST["time"] ?>" />
<br />
Open Channel:
<input type="hidden" name="channel"  />
<br />
Kill Process Id:
<input type="text" name="process" value="" />
<br />
<button style="height:100px; width:200px" type="submit" onclick="DoSubmit(0)">Touch me :)</button>
<br />
<input type="submit" value="Delay 5s" onclick="DoSubmit(5)"/>
<br />
<input type="submit" value="Delay 10s" onclick="DoSubmit(10)"/>
<br />
<input type="submit" value="Delay 15s" onclick="DoSubmit(15)"/>
<br />
<input type="submit" value="Delay 30s" onclick="DoSubmit(30)"/>
<br />
<input type="submit" value="Delay 1m" onclick="DoSubmit(60)"/>
<br />
<input type="submit" value="Delay By Input" onclick="DoSubmit(-1)"/>
<br />
<br />
<br />
<br />
<br />
<input type="submit" value="Open 1" onclick="DoChannel(1)" />
<input type="submit" value="Close 1" onclick="DoChannel(2)" />
<br />
<br />
<input type="submit" value="Open 2" onclick="DoChannel(3)" />
<input type="submit" value="Close 2" onclick="DoChannel(4)" />
<br />
<br />
<input type="submit" value="Open 3" onclick="DoChannel(5)" />
<input type="submit" value="Close 3" onclick="DoChannel(6)" />
</form>
<br />
<a href="mitmproxy_cer/mitmproxy-ca-cert.cer"> mitmproxy-ca-cert.cer </a>
<br />
<a href="mitmproxy_cer/mitmproxy-ca-cert.p12"> mitmproxy-ca-cert.p12</a>
<br />
<a href="mitmproxy_cer/mitmproxy-ca-cert.pem"> mitmproxy-ca-cert.pem</a>
<br />
<a href="mitmproxy_cer/mitmproxy-ca.pem"> mitmproxy-ca.pem </a>
<br />
<?php
echo "<pre> version(reboot) 0.010</pre>";
if ($_POST["run"] === 'I love Dandan Liu.' || $_POST["run"]==="I love you"){
	$op = $_POST["time"];
	$value = eval("return ($op);");
	$value = intval($value);
	$channel = intval($_POST["channel"]);
	$exestr='';
	if($value >= 0 && $_POST["process"] === '' && $channel === 0){
		$exestr = 'sh gpio4light.sh '.$value.' 0'.'  > /dev/null 2>&1 &';
		exec($exestr);
	}
	else if(channel===0){
		$exestr = 'sh killgpio.sh '.$_POST["process"].' >/dev/null 2>&1 &';
		exec($exestr);
	}
	else {
		$exestr = 'sh gpio4light.sh '.$value.' '.$channel.' > /dev/null 2>&1 &';
		exec($exestr);
	}
	echo "<pre>COMMAND: $exestr</pre>";
	echo "<pre>Finished.</pre>";
}
else if($_POST["run"] === 'reboot'){
	exec('sudo reboot');
}
else {
	echo "<pre>Please give me a command.</pre>";
}

echo "<pre>".strftime('%c')."</pre>";

$output = shell_exec('ps axo pid,bsdstart,command | grep gpio | grep -v grep');
echo "<pre>".nl2br($output)."</pre>";

?>

</body>
</html>
