<?php 

function makeThumbs($filename,$savepath,$w='',$h='') {
// Set a maximum height and width
$width = (!empty($w) ? $w : 93);
$height = (!empty($h) ? $h : 93);

	if(function_exists('exif_imagetype')) {
		$is_jpg = (exif_imagetype($filename) == IMAGETYPE_JPEG ? true : false);
		$is_gif = (exif_imagetype($filename) == IMAGETYPE_GIF ? true : false);
		$is_png = (exif_imagetype($filename) == IMAGETYPE_PNG ? true : false);
	} else {
		$is_jpg = (preg_match("/.jpg/",$filename) || preg_match("/.jpeg/",$filename) ? true : false);
		$is_gif = (preg_match("/.gif/",$filename) || preg_match("/.gif/",$filename) ? true : false);
		$is_png = (preg_match("/.png/",$filename) || preg_match("/.png/",$filename) ? true : false);
	}

// Get new dimensions
list($width_orig, $height_orig) = getimagesize($filename);

if ($width && ($width_orig < $height_orig)) {
    $width = ($height / $height_orig) * $width_orig;
} else {
    $height = ($width / $width_orig) * $height_orig;
}

// Resample
$image_p = imagecreatetruecolor($width, $height);
	
	
if ($is_jpg == true) $image = imagecreatefromjpeg($filename);
if ($is_gif == true) $image = imagecreatefromgif($filename);
if ($is_png == true) $image = imagecreatefrompng($filename);
imagecopyresized($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

// Output
if ($is_jpg == true) imagejpeg($image_p, $savepath, 80);
if ($is_gif == true) imagegif($image_p,$savepath);
if ($is_png == true) imagepng($image_p,$savepath);
imagedestroy($image);
return true;
}
?>
