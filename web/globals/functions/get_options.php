<?php
function get_options($table,$field,$output='select',$cvalue='',$klausa='',$cstyle='',$bvalue='',$lang='',$formName='') {

	$table = 'TBL_'.strtoupper($table);
	$table = _PFX_.constant($table);
	$getType = safeQuery($table,"SELECT * FROM",$klausa);
	$pageTotal = mysql_num_rows($getType);
	$lang = (!empty($lang) ? '_'.$lang : '');
	if($pageTotal <= 0) {
		$out = 'no_'.$field.'_found';
	} else {
		$pageTotal = mysql_num_rows($getType);
		while($t = mysql_fetch_array($getType)) {
			
			$tArray[] = array(
			'id' => $t[$field.'_id'],
			'name' => $t[$field.'_name'],
			'name_'.$lang => $t[$field.'_name'.$lang]
			);
		}
		switch($output) {
			case 'checkbox':
			$cvalue = ($cvalue == '' ? array('vid' => '') : $cvalue);
			$out = get_list_checkbox($tArray,$cvalue,$field.'[]',$cstyle='',$pageTotal); 
			break;
			case 'select':
			//$cvalue = ($cvalue == '' ? '' : $cvalue);
			$out = get_list_select(
					$vals=$tArray,
					$current_vals=$cvalue,
					$s_name=(!empty($formName) ? $formName : $field),
					$cstyle='',
					$blank_value=$bvalue,
					$language=$lang
					);
			break;
		}
	}
	return $out;
}
?>