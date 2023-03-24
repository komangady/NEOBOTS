<?php
/*********************************************************
	ADAPTED FROM TEXTPATTERN
	All copyrights & notices belong to the propriate owners.
*********************************************************/
// -------------------------------------------------------------------
	function getmicrotime() { 
    	list($usec, $sec) = explode(" ",microtime()); 
    	return ((float)$usec + (float)$sec); 
    }
	
	function eE($txt) // convert email address into unicode entities
	{
		 for ($i=0;$i<strlen($txt);$i++) { 
			  $ent[] = "&#".ord(substr($txt,$i,1)).";"; 
		 } 
		 if (!empty($ent)) return join('',$ent); 
	}
	// -------------------------------------------------------------
	function doStrip($in)
	{ 
		return doArray($in,'stripslashes'); 
	}
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

	// -------------------------------------------------------------
	function makeOut() 
	{
		foreach(func_get_args() as $a) {
			$array[$a] = htmlspecialchars(gps($a));
		}
		return $array;
	}

// -------------------------------------------------------------
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
	function serverSet($thing) // Get a var from $_SERVER global array, or create it 
	{
		return (isset($_SERVER[$thing])) ? $_SERVER[$thing] : '';
	}
	
	
	
	function unSlashIt($out)
	{
		return stripslashes($out);
	}
	
	function TagSC($out) 
	{
		return htmlspecialchars($out, ENT_QUOTES);
	}
	
	
	
	
	function dumbDown($str) 
	{
		$array = array( // nasty, huh?. 
			'&#192;'=>'A','&Agrave;'=>'A','&#193;'=>'A','&Aacute;'=>'A','&#194;'=>'A','&Acirc;'=>'A',
			'&#195;'=>'A','&Atilde;'=>'A','&#196;'=>'Ae','&Auml;'=>'A','&#197;'=>'A','&Aring;'=>'A',
			'&#198;'=>'Ae','&AElig;'=>'AE',			
			'&#256;'=>'A','&#260;'=>'A','&#258;'=>'A',			
			'&#199;'=>'C','&Ccedil;'=>'C','&#262;'=>'C','&#268;'=>'C','&#264;'=>'C','&#266;'=>'C',
			'&#270;'=>'D','&#272;'=>'D','&#208;'=>'D','&ETH;'=>'D',			
			'&#200;'=>'E','&Egrave;'=>'E','&#201;'=>'E','&Eacute;'=>'E','&#202;'=>'E','&Ecirc;'=>'E','&#203;'=>'E','&Euml;'=>'E',
			'&#274;'=>'E','&#280;'=>'E','&#282;'=>'E','&#276;'=>'E','&#278;'=>'E',
			'&#284;'=>'G','&#286;'=>'G','&#288;'=>'G','&#290;'=>'G',
			'&#292;'=>'H','&#294;'=>'H',
			'&#204;'=>'I','&Igrave;'=>'I','&#205;'=>'I','&Iacute;'=>'I','&#206;'=>'I','&Icirc;'=>'I','&#207;'=>'I','&Iuml;'=>'I',
			'&#298;'=>'I','&#296;'=>'I','&#300;'=>'I','&#302;'=>'I','&#304;'=>'I',
			'&#306;'=>'IJ',
			'&#308;'=>'J',
			'&#310;'=>'K',
			'&#321;'=>'K','&#317;'=>'K','&#313;'=>'K','&#315;'=>'K','&#319;'=>'K',
			'&#209;'=>'N','&Ntilde;'=>'N','&#323;'=>'N','&#327;'=>'N','&#325;'=>'N','&#330;'=>'N',
			'&#210;'=>'O','&Ograve;'=>'O','&#211;'=>'O','&Oacute;'=>'O','&#212;'=>'O','&Ocirc;'=>'O','&#213;'=>'O','&Otilde;'=>'O',
			'&#214;'=>'Oe','&Ouml;'=>'Oe',
			'&#216;'=>'O','&Oslash;'=>'O','&#332;'=>'O','&#336;'=>'O','&#334;'=>'O',
			'&#338;'=>'OE',
			'&#340;'=>'R','&#344;'=>'R','&#342;'=>'R',
			'&#346;'=>'S','&#352;'=>'S','&#350;'=>'S','&#348;'=>'S','&#536;'=>'S',
			'&#356;'=>'T','&#354;'=>'T','&#358;'=>'T','&#538;'=>'T',
			'&#217;'=>'U','&Ugrave;'=>'U','&#218;'=>'U','&Uacute;'=>'U','&#219;'=>'U','&Ucirc;'=>'U',
			'&#220;'=>'Ue','&#362;'=>'U','&Uuml;'=>'Ue',
			'&#366;'=>'U','&#368;'=>'U','&#364;'=>'U','&#360;'=>'U','&#370;'=>'U',
			'&#372;'=>'W',
			'&#221;'=>'Y','&Yacute;'=>'Y','&#374;'=>'Y','&#376;'=>'Y',
			'&#377;'=>'Z','&#381;'=>'Z','&#379;'=>'Z',
			'&#222;'=>'T','&THORN;'=>'T',			
			'&#224;'=>'a','&#225;'=>'a','&#226;'=>'a','&#227;'=>'a','&#228;'=>'ae',
			'&auml;'=>'ae',
			'&#229;'=>'a','&#257;'=>'a','&#261;'=>'a','&#259;'=>'a','&aring;'=>'a',
			'&#230;'=>'ae',
			'&#231;'=>'c','&#263;'=>'c','&#269;'=>'c','&#265;'=>'c','&#267;'=>'c',
			'&#271;'=>'d','&#273;'=>'d','&#240;'=>'d',
			'&#232;'=>'e','&#233;'=>'e','&#234;'=>'e','&#235;'=>'e','&#275;'=>'e',
			'&#281;'=>'e','&#283;'=>'e','&#277;'=>'e','&#279;'=>'e',
			'&#402;'=>'f',
			'&#285;'=>'g','&#287;'=>'g','&#289;'=>'g','&#291;'=>'g',
			'&#293;'=>'h','&#295;'=>'h',
			'&#236;'=>'i','&#237;'=>'i','&#238;'=>'i','&#239;'=>'i','&#299;'=>'i',
			'&#297;'=>'i','&#301;'=>'i','&#303;'=>'i','&#305;'=>'i',
			'&#307;'=>'ij',
			'&#309;'=>'j',
			'&#311;'=>'k','&#312;'=>'k',
			'&#322;'=>'l','&#318;'=>'l','&#314;'=>'l','&#316;'=>'l','&#320;'=>'l',
			'&#241;'=>'n','&#324;'=>'n','&#328;'=>'n','&#326;'=>'n','&#329;'=>'n',
			'&#331;'=>'n',
			'&#242;'=>'o','&#243;'=>'o','&#244;'=>'o','&#245;'=>'o','&#246;'=>'oe',
			'&ouml;'=>'oe',
			'&#248;'=>'o','&#333;'=>'o','&#337;'=>'o','&#335;'=>'o',
			'&#339;'=>'oe',
			'&#341;'=>'r','&#345;'=>'r','&#343;'=>'r',
			'&#353;'=>'s',
			'&#249;'=>'u','&#250;'=>'u','&#251;'=>'u','&#252;'=>'ue','&#363;'=>'u',
			'&uuml;'=>'ue',
			'&#367;'=>'u','&#369;'=>'u','&#365;'=>'u','&#361;'=>'u','&#371;'=>'u',
			'&#373;'=>'w',
			'&#253;'=>'y','&#255;'=>'y','&#375;'=>'y',
			'&#382;'=>'z','&#380;'=>'z','&#378;'=>'z',
			'&#254;'=>'t',
			'&#223;'=>'ss',
			'&#383;'=>'ss',
			'&agrave;'=>'a','&aacute;'=>'a','&acirc;'=>'a','&atilde;'=>'a','&auml;'=>'ae',
			'&aring;'=>'a','&aelig;'=>'ae','&ccedil;'=>'c','&eth;'=>'d',
			'&egrave;'=>'e','&eacute;'=>'e','&ecirc;'=>'e','&euml;'=>'e',
			'&igrave;'=>'i','&iacute;'=>'i','&icirc;'=>'i','&iuml;'=>'i',
			'&ntilde;'=>'n',
			'&ograve;'=>'o','&oacute;'=>'o','&ocirc;'=>'o','&otilde;'=>'o','&ouml;'=>'oe',
			'&oslash;'=>'o',
			'&ugrave;'=>'u','&uacute;'=>'u','&ucirc;'=>'u','&uuml;'=>'ue',
			'&yacute;'=>'y','&yuml;'=>'y',
			'&thorn;'=>'t',
			'&szlig;'=>'ss'
		);


		if (is_file(PATH_CLASSES.'/i18n-ascii.txt')) {
			$i18n = parse_ini_file(PATH_CLASSES.'/i18n-ascii.txt');
			$array = array_merge($array,$i18n);
		}

		return strtr($str, $array);
	}
	
	function bombShelter() // protection from those who'd bomb the site by GET
	{
		global $prefs;
		$in = $_SERVER['REQUEST_URI'];
		if (!empty($prefs['max_url_len']) and strlen($in) > $prefs['max_url_len']) exit('Nice try.');
	}
	
	function set_error_level($level)
	{

		if ($level == 'debug') {
			error_reporting(E_ALL);
		}
		elseif ($level == 'live') {
			// don't show errors on screen
			error_reporting(E_ALL ^ (E_WARNING | E_NOTICE));
			@ini_set("display_errors","1");
		}
		else {
			// default is 'testing': display everything except notices
			error_reporting(E_ALL ^ (E_NOTICE));
		}
	}
	
	// Converting title to be url
	
// -------------------------------------------------------------
	function escape_title($title)
	{
		return strtr($title,
			array(
				'<' => '&#60;',
				'>' => '&#62;',
				"'" => '&#39;',
				'"' => '&#34;',
			)
		);
	}

// -------------------------------------------------------------
	function escape_output($str)
	{
		# should be safe for xhtml and xml
		return strtr($str,
			array(
				'&' => '&#38;',
				'<' => '&#60;',
				'>' => '&#62;',
				"'" => '&#39;',
				'"' => '&#34;',
			)
		);
	}

// -------------------------------------------------------------
	function escape_tags($str)
	{
		return strtr($str,
			array(
				'<' => '&#60;',
				'>' => '&#62;',
			)
		);
	}

// -------------------------------------------------------------
	function escape_cdata($str)
	{
		return '<![CDATA['.str_replace(']]>', ']]]><![CDATA[]>', $str).']]>';
	}

//-------------------------------------------------------------
	function gTxt($var, $atts=array())
	{
		global $textarray;
		if(isset($textarray[strtolower($var)])) {
			$out = $textarray[strtolower($var)];
			return strtr($out, $atts);
		}

		if ($atts)
			return $var.': '.join(', ', $atts);
		return $var;
	}
//-------------------------------------------------------------
	function assert_int($myvar) {
		global $production_status;

		if (is_numeric($myvar) and $myvar == intval($myvar)) {
			return (int) $myvar;
		} else {
		//trigger_error("'".htmlspecialchars($myvar)."' is not an integer.", E_USER_WARNING);
		return false;
		}
	}
?>
