<?php
function get_url() {
global $admin_dir,$subdir;
extract($GLOBALS['prefs']);
$furl = $_SERVER['HTTP_HOST'];
$furl = str_replace("www.","", $furl);
	if($furl !== $site_domain) {
		print 'http://'.$furl.'/'.$subdir.$admin_dir.'/';
		return;
	} else {
		print 'http://'.$furl.$admin_dir.'/';
		return;
	}
}
?>
