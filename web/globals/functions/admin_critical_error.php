<?php
function admin_critical_error($subject='',$msg='') {
extract($GLOBALS['prefs']);
	$headers = 'From: error@'.$site_domain.'' . "\r\n" .
    'Reply-To: no-reply@'.$site_domain.'' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

	$subject = (empty($subject) ? '[Subject Missing]' : $subject);
	if(empty($msg)) return;
	return mail($root_email, $subject, $msg, $headers);
}
?>
