<?php
function TagDecode($out) 
{
	if( phpversion() >= 5) {
		return html_entity_decode($out, ENT_QUOTES, 'UTF-8');
	} else {
		return html_entity_decode($out, ENT_QUOTES);
	}
}
?>
