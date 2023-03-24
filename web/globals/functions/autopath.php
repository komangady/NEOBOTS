<?php
function path($end) {
	$alamat=$_SERVER['PHP_SELF'];
	$address=explode("/",$alamat);
	$endaddress=end($address);
	$_RESULT=str_replace("$endaddress","",$alamat);
	echo $_SERVER['HTTP_HOST'],$_RESULT,$end;
}
?>
