<?php

function tahunAjaran($s_name,$yStart,$yEnd,$c_vals,$blank_value='',$csClass='') {
	$out = '<select name="'.$s_name.'" id="'.$s_name.'" class="'.$csClass.'">'."\n";
	$out .= '<option value=""> '.(!empty($blank_value) ? ucwords(str_replace("_"," ",$blank_value)) : '&#160;').' </option>'."\n";
	for($thn=$yStart;$thn <= $yEnd; $thn++) {
		$selectedy = ($thn == $c_vals) ? ' selected="selected"' : '';
		$out .= '<option value="'.$thn.'"'.$selectedy.'>'.$thn.'/'.($thn+1).'</option>';
	}
	$out .= '</select>'."\n";
	return $out;
}


?>
