<?php
function page_not_found($file) {
	$msg = '<div class="error"><h4>ERROR 404 [Object Not Found]</h4>';
	$msg .= '<p>The page <strong>'.$file.'</strong> can not be found.</p>';
	$msg .= '<p>Please contact administrator about this error.</p>';
	$msg .= '</div>';
	return $msg;
}
?>
