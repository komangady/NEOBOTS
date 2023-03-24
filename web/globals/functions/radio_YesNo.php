<?php
function radio_YesNo($vals,$current_vals,$s_name,$s_id,$cstyle="") {
	$out = '';
	foreach($vals as $value=>$key) {  
		$checked = (($value == $current_vals) ? 'checked="checked"' : '');
	$out .= '
	<input type="radio" id="'.$s_id.'-'.$s_name.'-'.$value.'" name="'.$s_name.'" value="'.$value.'" '.$checked.' '.$cstyle.' />
	<label for="'.$s_id.'-'.$s_name.'-'.$value.'">'.$key.'</label>
	';
	}
	return $out;
}
?>