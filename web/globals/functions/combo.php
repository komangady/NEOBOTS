<?php
function jumlah($s_name,$yStart,$yEnd,$c_vals,$blank_value='',$csClass='') {
	$out = '<select name="'.$s_name.'" id="'.$s_name.'" class="'.$csClass.'">'."\n";
	$out .= '<option value=""> '.(!empty($blank_value) ? ucwords(str_replace("_"," ",$blank_value)) : '&#160;').' </option>'."\n";
	for($jml=$yStart;$jml <= $yEnd; $jml++) {
		$selectedy = ($jml == $c_vals) ? ' selected="selected"' : '';
		$out .= '<option value="'.$jml.'"'.$selectedy.'>'.$jml.'</option>';
	}
	$out .= '</select>'."\n";
	return $out;
}

?>