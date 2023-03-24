<?php
function doArray($in,$function)
{
	return is_array($in) ? array_map($function,$in) : $function($in); 
}

function SlashIt($in)
{ 
	if(phpversion() >= "4.3.0") {
		return doArray($in,'mysql_real_escape_string');
	} else {
		return doArray($in,'mysql_escape_string');
	}
}
?>
