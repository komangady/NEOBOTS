<?php
/*********************************************
	ADAPTED FROM TEXTPATTERN (Dean Allen)
	extended by: Adi Saputra Yasa
**********************************************/

/* FIXME: have to convert mysql-timestamps to unixtimestamps first. Are timezones ok?
	if($send_lastmod) {
		$last = gmdate("D, d M Y H:i:s \G\M\T",$lastmod);
		header("Last-Modified: $last");

		$hims = serverset('HTTP_IF_MODIFIED_SINCE');
		if ($hims == $last) {
			header("HTTP/1.1 304 Not Modified");
			exit; 
		}
	}
*/
	// -------------------------------------------------------------
	function gps($thing) // checks GET and POST for a named variable, or creates it blank
	{
		if (isset($_GET[$thing])) {
			if ('MAGIC_QUOTES_GPC') {
				return doStrip($_GET[$thing]);
			} else {
				return $_GET[$thing];
			}
		} elseif (isset($_POST[$thing])) {
			if ('MAGIC_QUOTES_GPC') {
				return doStrip($_POST[$thing]);
			} else {
				return $_POST[$thing];
			}
		}
		return '';
	}
	
	function makeOut() 
	{
		foreach(func_get_args() as $a) {
			$array[$a] = htmlspecialchars(gps($a));
		}
		return $array;
	}
	
	function serverSet($thing) // Get a var from $_SERVER global array, or create it 
	{
		return (isset($_SERVER[$thing])) ? $_SERVER[$thing] : '';
	}
	
	function chopUrl($req) 
	{
		$req = urldecode(strtolower($req));
		//strip off query_string, if present
		$qs = strpos($req,'?');
		if ($qs) $req = substr($req, 0, $qs);
		$req = preg_replace('/index\.php$/', '', $req);
		$r = explode('/',$req);
		$o['u0'] = (!empty($r[0])) ? $r[0] : '';
		$o['u1'] = (!empty($r[1])) ? $r[1] : '';
		$o['u2'] = (!empty($r[2])) ? $r[2] : '';
		$o['u3'] = (!empty($r[3])) ? $r[3] : '';
		$o['u4'] = (!empty($r[4])) ? $r[4] : '';
		$o['u5'] = (!empty($r[5])) ? $r[5] : '';

		return $o;
	}
	
// -------------------------------------------------------------
	function preText($url_type) 
	{	
		// set messy variables
		$out =  makeOut('');
		// some useful vars for taghandlers, plugins
		$out['request_uri'] = serverSet('REQUEST_URI');
		$out['qs'] = serverSet('QUERY_STRING');
		// IIS - can someone confirm whether or not this works?
		if (!$out['request_uri'] and $argv = serverSet('argv'))
			$out['request_uri'] = @substr($argv[0], strpos($argv[0], ';' + 1));
		// IIS again - given that the above doesn't always seem to help...
		if (!$out['request_uri'] and serverSet('SCRIPT_NAME'))
			$out['request_uri'] = serverSet('SCRIPT_NAME').( (serverSet('QUERY_STRING')) ? '?'.serverSet('QUERY_STRING') : '');

		// define the useable url, minus any subdirectories.
		// this is pretty fugly, if anyone wants to have a go at it - dean
		$out['subpath'] = $subpath = preg_quote(preg_replace("/http:\/\/.*(\/.*)/Ui","$1",site_root),"/");
		$out['req'] = $req = preg_replace("/^$subpath/i","/",serverSet('REQUEST_URI'));

		$is_404 = 0;
		extract(chopUrl($req));
		if (in_array($u1, $GLOBALS['valid_section'])) {
			$out['mod'] = $u1;
		} else {
			//header("HTTP/1.0 404 Not Found");
			$out['mod'] = 'notfound';
		}
		
		
		if (!empty($u2)) {
			$out['com'] = $u2;
		} else {
			$out['com'] = '';
		}
		
	
		
		if(empty($u1)) { $out['mod'] = 'main'; $out['com'] = 'mainpage'; }
		
		return $out; 

	}

?>