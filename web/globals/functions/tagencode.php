<?php
function TagEncode($out) 
{
	return htmlentities($out, ENT_QUOTES, 'UTF-8');
}
?>