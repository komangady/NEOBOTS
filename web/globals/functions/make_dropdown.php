<?php
function make_dropdown($vals,$current_vals,$s_name,$cstyle='',$blank_value='',$style='') {
	$res = '<select name="'.$s_name.'" id="'.$s_name.'" class="'.$cstyle.'" style="'.$style.'" >'."\n";
	$res .= '<option value=""> '.(!empty($blank_value) ? ucwords(str_replace("_"," ",$blank_value)) : '&#160;').' </option>'."\n";
		foreach($vals as $value) {       
			if($value[0] == $current_vals) {
				$res .= '<option value="'.$value[0].'" selected>'.ucwords(str_replace("_"," ",$value[1])).'</option>'."\n";
				continue;
			}
			$res .= '<option value="'.$value[0].'" >'.ucwords(str_replace("_"," ",$value[1])).'</option>'."\n";
		}
	$res .= '</select>'."\n";
	return $res;
}
function make_dropdown_forkrs($vals,$current_vals,$s_name,$id_name='',$cstyle='',$blank_value='',$style='') {
	$res = '<select name="'.$s_name.'" id="'.$id_name.'" class="'.$cstyle.'" style="'.$style.'" >'."\n";
	$res .= '<option value=""> '.(!empty($blank_value) ? ucwords(str_replace("_"," ",$blank_value)) : '&#160;').' </option>'."\n";
		foreach($vals as $value) {       
			if($value[0] == $current_vals) {
				$res .= '<option value="'.$value[0].'" selected>'.ucwords(str_replace("_"," ",$value[1])).'</option>'."\n";
				continue;
			}
			$res .= '<option value="'.$value[0].'" >'.ucwords(str_replace("_"," ",$value[1])).'</option>'."\n";
		}
	$res .= '</select>'."\n";
	return $res;
}
function make_dropdown_notnull($vals,$current_vals,$s_name,$cstyle='',$blank_value='',$style='') {
	$res = '<select name="'.$s_name.'" id="'.$s_name.'" class="'.$cstyle.'" style="'.$style.'" >'."\n";
	
		foreach($vals as $value) {       
			if($value[0] == $current_vals) {
				$res .= '<option value="'.$value[0].'" selected>'.ucwords(str_replace("_"," ",$value[1])).'</option>'."\n";
				continue;
			}
			$res .= '<option value="'.$value[0].'" >'.ucwords(str_replace("_"," ",$value[1])).'</option>'."\n";
		}
	$res .= '</select>'."\n";
	return $res;
}
function make_dropdown_encrypt($vals,$current_vals,$s_name,$cstyle='',$blank_value='',$style='') {
	$res = '<select name="'.$s_name.'" id="'.$s_name.'" class="'.$cstyle.'" style="'.$style.'" >'."\n";
	$res .= '<option value=""> '.(!empty($blank_value) ? ucwords(str_replace("_"," ",$blank_value)) : '&#160;').' </option>'."\n";
		foreach($vals as $value) {       
			if($value[0] == $current_vals) {
				$res .= '<option value="'.MyEncrypt($value[0]).'" selected>'.ucwords(str_replace("_"," ",$value[1])).'</option>'."\n";
				continue;
			}
			$res .= '<option value="'.MyEncrypt($value[0]).'" >'.ucwords(str_replace("_"," ",$value[1])).'</option>'."\n";
		}
	$res .= '</select>'."\n";
	return $res;
}
?>