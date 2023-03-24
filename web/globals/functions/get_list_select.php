<?php
function get_list_select($vals,$current_vals,$s_name,$cstyle='',$blank_value='',$language='') {

	$res = '<select name="'.$s_name.'" class="'.$cstyle.'">'."\n";
	$res .= '<option value=""> '.(!empty($blank_value) ? ucwords(str_replace("_"," ",$blank_value)) : '&#160;').' </option>'."\n";
		foreach($vals as $key => $value) { 
			if($value['id'] == $current_vals) {
				$res .= '<option value="'.$value['id'].'" selected="selected">'
				.(!empty($language) && isset($value['name_'.$language]) && !empty($value['name_'.$language]) ? $value['name_'.$language] : ucwords(str_replace("_"," ",$value['name']))).
				'</option>'."\n";
				continue;
			}
			$res .= '<option value="'.$value['id'].'">'
			.(!empty($language) && isset($value['name_'.$language]) && !empty($value['name_'.$language]) ? $value['name_'.$language] : ucwords(str_replace("_"," ",$value['name']))).
			'</option>'."\n";
		}
	$res .= '</select>'."\n";
	return $res;
}
?>