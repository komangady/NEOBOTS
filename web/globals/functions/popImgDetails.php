<?php
function popImgDetails($img,$alt,$custom = 0) {
global $imgdir;
	if($custom == 0) {
		list($width,$height) = getimagesize($imgdir.$img.'.jpg');
		$output_path = $imgdir.$img.'.jpg';
	} else {
		list($width,$height) = getimagesize($img);
		$output_path = $img;
	}
	//$result = 'popWindow(\'jpg\',\''.$output_path.'\',\''.$width.'\',\''.$height.'\',\''.SlashIt($alt).'\',\'10\',\'10\');';
	$result = "open('preview.php?id=$output_path', 'newWindow', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbar=auto,resizable=yes,copyhistory=no,width=$width,height=$height,left=10,top=10,screenX=10,screenY=10');";
	return $result;
}
?>