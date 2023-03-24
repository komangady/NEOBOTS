<?php
	function imgChk($img, $output = 'actual') {
global $imgdir,$imgNewItemdir,$imgthumbdir,$thumb_ext,$imgNewItem_ext;
	if( $output == 'thumb' ) {
		$fimg = $imgthumbdir . $thumb_ext . $img . '.jpg';
	} elseif( $output == 'actual' ) {
		$fimg = $imgdir . $img . '.jpg';
	} elseif( $output == 'new_img' ) {
		$fimg = $imgNewItemdir . $imgNewItem_ext . $img . '.jpg';
	}
	( file_exists($fimg) ) ? $out = 'Image Found' : $out = '<span class="red">Image Not Found</span>';
	return $out;
}
?>
