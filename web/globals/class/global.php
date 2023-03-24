<?php



$file = 'global.php';

if(@eregi($file, $_SERVER['SCRIPT_NAME'])) die('You Can Not Access This File Directly!');



// MYSQL CONNECTION & QUERY CLASS

$method = 'mysql_query';

$qcount = '';

class DB {

		

	function DB() {

	global $dhost;

	global $duser;

	global $dbase;

	global $dpass;

	$this->link = @mysql_connect($dhost,$duser,$dpass,$dbase);

	if(!$this->link) die(db_down());

	if(!$this->link) {

	$GLOBALS['connected'] = false;

	} else $GLOBALS['connected'] = true;

		@mysql_select_db($dbase) or die(db_down());

		mysql_query("SET NAMES utf8", $this->link);

	}

	

	function doQuery($methoda,$sql) {

	global $qcount;

		$result = $methoda($sql, $this->link);

		if(!$result) { 

			$erNum = mysql_errno();

			$msg = mysql_error();

			query_error($erNum,$msg);

			return false; 

		}

		@$qcount++;

		return $result;

	}

	

}

$DB = new DB;

	

	function query_error($xNum,$msg) {

	global $production_status;

		switch($xNum) {

			case '1062':

				$res = 'Duplicate Entry. Some other items already exists.';

			break;

			default:

				$res = $msg;

			break;

		}

		if(@$production_status == 'live') { 

			return;

		} else {

			echo '<h4 class="error">'.$res.'</h4>';

			return;

		}

	}

	

	function safeQuery($tabel,$cond,$klausa = '') {

	global $method,$DB;

		$sql = $cond.' '.$tabel.' '.$klausa;

		$query = $DB->doQuery($method,$sql);	

		return $query;

	}

	

	function safeInsert($tabel,$fields,$values) {

	global $method,$DB;

		$tag = 'INSERT INTO';

		$sql = $tag.' '.$tabel.' ('.$fields.') VALUES('.$values.')';

		$query = $DB->doQuery($method,$sql);	

		return $query;

	}

	

	function safeUpdate($tabel,$values,$klausa) {

	global $method,$DB;

		$tag = 'UPDATE';

		$sql = $tag.' '.$tabel.' SET '.$values.' '.$klausa;

		$query = $DB->doQuery($method,$sql);	

		return $query;

	}

	

	function forceUpdate($tabel,$fields,$values) {

	global $method,$DB;

		$tag = 'REPLACE INTO';

		$sql = $tag.' '.$tabel.' ('.$fields.') VALUES('.$values.')';

				//echo $sql;

		$query = $DB->doQuery($method,$sql);	

		return $query;

	}

	

	function safeDelete($tabel,$klausa) {

	global $method,$DB;

		$tag = 'DELETE';

		$sql = $tag.' FROM '.$tabel.' '.$klausa;

		$query = $DB->doQuery($method,$sql);	

		return $query;

	}

	

	function customQuery($sql,$debug = '') {

	global $method,$DB;

		$query = $DB->doQuery($method,$sql);	

		return $query;

	}

	

	function LockInsert($klausa) {

	global $method,$DB;

		$query = $DB->doQuery($method,$klausa);	

		return $query;

	}



	// -------------------------------------------------------------

	function safe_update($table, $set, $where, $debug='') 

	{

		$q = "update ".$table." set $set where $where";

		if ($r = customQuery($q,$debug)) {

			return true;

		}

		return false;

	}



// -------------------------------------------------------------

	function safe_row($things, $table, $where, $debug='') 

	{

		$q = "select $things from ".$table." where $where";

		print $q;

		$rs = getRow($q,$debug);

		if ($rs) {

			return $rs;

		}

		return array();

	}



// -------------------------------------------------------------

	function safe_rows($things, $table, $where, $debug='') 

	{

		$q = "select $things from ".$table." where $where";

		print $q;

		$rs = getRows($q,$debug);

		if ($rs) {

			return $rs;

		}

		return array();

	}

	

// -------------------------------------------------------------

	function safe_rows_start($things, $table, $where, $debug='') 

	{

		$q = "select $things from ".$table." where $where";

		echo $q;

		return startRows($q,$debug);

	}

	

//-------------------------------------------------------------

	function startRows($query,$debug='')

	{

		return customQuery($query,$debug);

	}



// -------------------------------------------------------------

	function safe_column($thing, $table, $where, $debug='') 

	{

		$q = "select $thing from ".$table." where $where";

		$rs = getRows($q,$debug);

		if ($rs) {

			foreach($rs as $a) {

				$v = array_shift($a);

				$out[$v] = $v;

			}

			return $out;

		}

		return array();

	}

	

//-------------------------------------------------------------

	function nextRow($r)

	{

		$row = mysql_fetch_assoc($r);

		if ($row === false)

			mysql_free_result($r);

		return $row;

	}



//-------------------------------------------------------------

	function getRow($query,$debug='') 

	{

		if ($r = customQuery($query,$debug)) {

			$row = (mysql_num_rows($r) > 0) ? mysql_fetch_assoc($r) : false;

			mysql_free_result($r);

			return $row;

		}

		return false;

	}



//-------------------------------------------------------------

	function getRows($query,$debug='') 

	{

		if ($r = customQuery($query,$debug)) {

			if (mysql_num_rows($r) > 0) {

				while ($a = mysql_fetch_assoc($r)) $out[] = $a; 

				mysql_free_result($r);

				return $out;

			}

		}

		return false;

	}





// -------------------------------------------------------------

	function db_down() 

	{

		// 503 status might discourage search engines from indexing or caching the error message

		// Adapted from textpattern - www.textpattern.com

		header('Status: 503 Service Unavailable');

		$error = mysql_error();

		return <<<eod

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"

        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />

	<title>Untitled</title>

</head>

<body>

<div align="center">

<h4 style="margin-top:4em">Database unavailable.</h4>

</div>

<!-- $error -->



</body>

</html>

eod;

	}

?>