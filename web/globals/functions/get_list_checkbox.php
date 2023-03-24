<?php
function get_list_checkbox($option,$values,$c_name,$cstyle='',$pageTotal) {
	$out = '<table width="100%" border="0" cellspacing="0" cellpadding="0"'.(!empty($cstyle) ? ' style="'.$cstyle.'"' : '').'><tr>';
		$n=0;
		foreach($option as $key => $value) {
		extract($value);
		//extract($values);

		$n++;
			(in_array($id,$values) ? $checked = 'checked="checked"' : $checked = '');
			$out .= '<td width="33%"><input type="checkbox" name ="'.$c_name.'" value="'.$id.'" '.$checked.' /> '.$name.'</td>';
			if($n % 3) {
			continue;
			} else {
				$out .= "</tr><tr>";
			}
		}
		$out .= '</table>';
	return $out;
}
function get_list_checkbox_kelas($option,$values,$c_name,$cstyle='',$pageTotal='') {
	$out = '<table width="100%" border="0" cellspacing="0" cellpadding="0"'.(!empty($cstyle) ? ' style="'.$cstyle.'"' : '').'><tr>';
		$n=0;
		foreach($option as $key => $value) {
		//extract($value);
		//extract($values);
		
		$n++;
			
			if(in_array($value[0],$values)){
				$checked = 'checked="checked"';
			}else{
				$checked = '';
			}//(in_array($value[0],$values) ? $checked = 'checked="checked"' : $checked = '');
			$out .= '<td width="33%"><input type="checkbox" name ="'.$c_name.'" value="'.$value[0].'" '.$checked.' /> '.$value[1].'</td>';
			if($n % 3) {
			continue;
			} else {
				$out .= "</tr><tr>";
			}
		}
		$out .= '</table>';
	return $out;
}
?>