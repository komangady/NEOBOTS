<?php
function make_url_changer($vals,$current_vals,$s_name,$change_var='',$cstyle="") {
	$res = '<select name="'.$s_name.'" class="'.$cstyle.'" onchange="jumpMenu(\'parent\',this,0);">'."\n";
	$res .= '<option value=""> </option>'."\n";
		foreach($vals as $value) {       
			if($value == $current_vals) {
				$res .= '<option value="'.(!empty($change_var) ? '?'.$change_var.'=' : '').$value.'" selected>'.ucwords(str_replace("_"," ",$value)).'</option>'."\n";
				continue;
			}
			$res .= '<option value="'.(!empty($change_var) ? '?'.$change_var.'=' : '').$value.'">'.ucwords(str_replace("_"," ",$value)).'</option>'."\n";
		}
	$res .= '</select>'."\n";
	return $res;
}
?>