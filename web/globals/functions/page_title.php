<?php
function page_title() {
extract($GLOBALS['prefs']);
	$res = $site_domain;
	(isset($_GET['rt'])) ? $res .= ' - '.ucwords($_GET['rt']) : '';
	(isset($_GET['com_opt'])) ? $res .= ' - '.ucwords(str_replace("_"," ",$_GET['com_opt'])) : '';
	(isset($_GET['id'])) ? $res .= ' : '.ucwords($_GET['id']) : '';
	return $res;
}
?>
