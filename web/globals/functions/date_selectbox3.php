<?php

/** Form - Dates Helper **/
function dateListBox($s_name,$c_vals,$blank_value='',$csClass='') {
	$out = '<select name="'.$s_name.'" id="'.$s_name.'" class="'.$csClass.'">'."\n";
	$out .= '<option value=""> '.(!empty($blank_value) ? ucwords(str_replace("_"," ",$blank_value)) : '&#160;').' </option>'."\n";
	for($tgl=1; $tgl <= 31;$tgl++) {
		$tglOutput = (strlen($tgl) == 2 ? $tgl : '0'.$tgl);
		$selected = ($tglOutput == $c_vals) ? ' selected="selected"' : '';
		$out .= '<option value="'.$tglOutput.'"'.$selected.'>'.$tglOutput.'</option>';
	}
	$out .= '</select>'."\n";
	return $out;
}

function monthListBox($s_name,$c_vals,$blank_value='',$csClass='') {
	$out = '<select name="'.$s_name.'" id="'.$s_name.'" class="'.$csClass.'">'."\n";
	$out .= '<option value=""> '.(!empty($blank_value) ? ucwords(str_replace("_"," ",$blank_value)) : '&#160;').' </option>'."\n";
	for($bln=1; $bln <= 12;$bln++) {
			$blnOutput = (strlen($bln) == 2 ? $bln : '0'.$bln);
			$bulan = array(
							'01' => 'January',
							'02' => 'February',
							'03' => 'March',
							'04' => 'April',
							'05' => 'May',
							'06' => 'June',
							'07' => 'July',
							'08' => 'August',
							'09' => 'September',
							'10' => 'October',
							'11' => 'November',
							'12' => 'December'							
						);
		$selectedm = ($blnOutput == $c_vals) ? ' selected="selected"' : '';
		$out .= '<option value="'.$blnOutput.'"'.$selectedm.'>'.$bulan[$blnOutput].'</option>';
		}
	$out .= '</select>'."\n";
	return $out;
}

function yearListBox($s_name,$yStart,$yEnd,$c_vals,$blank_value='',$csClass='') {
	$out = '<select name="'.$s_name.'" id="'.$s_name.'" class="'.$csClass.'">'."\n";
	$out .= '<option value=""> '.(!empty($blank_value) ? ucwords(str_replace("_"," ",$blank_value)) : '&#160;').' </option>'."\n";
	for($thn=$yStart;$thn <= $yEnd; $thn++) {
		$selectedy = ($thn == $c_vals) ? ' selected="selected"' : '';
		$out .= '<option value="'.$thn.'"'.$selectedy.'>'.$thn.'</option>';
	}
	$out .= '</select>'."\n";
	return $out;
}


?>