<?php
function imgOutput($img, $alt, $output = 'thumb') {
global $imgdir,$imgthumbdir,$thumb_ext;
	if( $output == 'thumb' ) {
		$fimg = $imgthumbdir . $thumb_ext . $img . '.jpg';
	} elseif( $output == 'actual' ) {
		$fimg = $imgdir . $img . '.jpg';
	}
	list($width, $height) = getimagesize($fimg);
	$out = '<img src="'.$fimg.'" width="'.$width.'" height="'.$height.'" alt="'.$alt.'" />';
	return $out;
}

?>