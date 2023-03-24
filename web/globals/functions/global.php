<?php


function makeThumbs($filename,$savepath,$w='',$h='') {
// Set a maximum height and width
$width = (!empty($w) ? $w : 93);
$height = (!empty($h) ? $h : 93);

	if(function_exists('exif_imagetype')) {
		$is_jpg = (exif_imagetype($filename) == IMAGETYPE_JPEG ? true : false);
		$is_gif = (exif_imagetype($filename) == IMAGETYPE_GIF ? true : false);
		$is_png = (exif_imagetype($filename) == IMAGETYPE_PNG ? true : false);
	} else {
		$is_jpg = (preg_match("/.jpg/",$filename) || preg_match("/.jpeg/",$filename) ? true : false);
		$is_gif = (preg_match("/.gif/",$filename) || preg_match("/.gif/",$filename) ? true : false);
		$is_png = (preg_match("/.png/",$filename) || preg_match("/.png/",$filename) ? true : false);
	}

// Get new dimensions
list($width_orig, $height_orig) = getimagesize($filename);

if ($width && ($width_orig < $height_orig)) {
    $width = ($height / $height_orig) * $width_orig;
} else {
    $height = ($width / $width_orig) * $height_orig;
}

// Resample
$image_p = imagecreatetruecolor($width, $height);
	
	
if ($is_jpg == true) $image = imagecreatefromjpeg($filename);
if ($is_gif == true) $image = imagecreatefromgif($filename);
if ($is_png == true) $image = imagecreatefrompng($filename);
imagecopyresized($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

// Output
if ($is_jpg == true) imagejpeg($image_p, $savepath, 80);
if ($is_gif == true) imagegif($image_p,$savepath);
if ($is_png == true) imagepng($image_p,$savepath);
imagedestroy($image);
return true;
}

function MyEncrypt($sData, $sKey)
{
  $sResult = '';

  for($i = 0; $i < strlen($sData); $i ++)
  {
	 $sChar    = substr($sData, $i, 1);
	 $sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1);
	 $sChar    = chr(ord($sChar) + ord($sKeyChar));
	 $sResult .= $sChar;
  }

  return MyEncode_base64($sResult);
}

function MyDecrypt($sData, $sKey)
{
  $sResult = '';
  $sData   = MyDecode_base64($sData);

  for($i = 0; $i < strlen($sData); $i ++)
  {
	 $sChar    = substr($sData, $i, 1);
	 $sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1);
	 $sChar    = chr(ord($sChar) - ord($sKeyChar));
	 $sResult .= $sChar;
  }

  return $sResult;
}

function MyEncode_base64($sData)
{
  $sBase64 = base64_encode($sData);

  return strtr($sBase64, '+/', '-_');
}

function MyDecode_base64($sData)
{
  $sBase64 = strtr($sData, '-_', '+/');

  return base64_decode($sBase64);
}

/////////////////////////////
function fileDelete($filepath,$filename) {
	if (file_exists($filepath.$filename)&&$filename!=""&&$filename!="n/a") {
		unlink ($filepath.$filename);
		return TRUE;	
	}else{
		return FALSE;
	}
}


function timer_start() {
    global $timestart;
    $mtime = microtime();
    $mtime = explode(" ",$mtime);
    $mtime = $mtime[1] + $mtime[0];
    $timestart = $mtime;
    return true;
}

function timer_stop($display=0,$precision=3) { //if called like timer_stop(1), will echo $timetotal
    global $timestart,$timeend;
    $mtime = microtime();
    $mtime = explode(" ",$mtime);
    $mtime = $mtime[1] + $mtime[0];
    $timeend = $mtime;
    $timetotal = $timeend-$timestart;
    if ($display)
        echo number_format($timetotal,$precision);
    return $timetotal;
}
// -------------------------------------------------------------------

function page_title() {
extract($GLOBALS['prefs']);
	$res = $site_domain;
	(isset($_GET['rt'])) ? $res .= ' - '.ucwords($_GET['rt']) : '';
	(isset($_GET['com_opt'])) ? $res .= ' - '.ucwords(str_replace("_"," ",$_GET['com_opt'])) : '';
	(isset($_GET['id'])) ? $res .= ' : '.ucwords($_GET['id']) : '';
	return $res;
}

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

function make_url_changer($vals,$current_vals,$s_name,$change_var='',$cstyle="") {
	$res = '<select name="'.$s_name.'" class="'.$cstyle.'" onchange="jumpMenu(\'parent\',this,0);">'."\n";
	$res .= '<option value=""> </option>'."\n";
		foreach($vals as $value) {       
			if($value == $current_vals) {
				$res .= '<option value="'.(!empty($change_var) ? '?'.$change_var.'=' : '').$value.'" selected>'.ucwords(str_replace("_"," ",$value)).'</option>'."\n";
				continue;
			}
			$res .= '<option value="'.(!empty($change_var) ? '?'.$change_var.'=' : '').$value.'">'.ucwords(str_replace("_"," ",$value)).'</option>'."\n";
		}
	$res .= '</select>'."\n";
	return $res;
}

function make_dropdown($vals,$current_vals,$s_name,$cstyle='',$blank_value='',$style='') {
	$res = '<select name="'.$s_name.'" id="'.$s_name.'" class="'.$cstyle.'" style="'.$style.'" >'."\n";
	$res .= '<option value=""> '.(!empty($blank_value) ? ucwords(str_replace("_"," ",$blank_value)) : '&#160;').' </option>'."\n";
		foreach($vals as $value) {       
			if($value[0] == $current_vals) {
				$res .= '<option value="'.$value[0].'" selected>'.ucwords(str_replace("_"," ",$value[1])).'</option>'."\n";
				continue;
			}
			$res .= '<option value="'.$value[0].'" >'.ucwords(str_replace("_"," ",$value[1])).'</option>'."\n";
		}
	$res .= '</select>'."\n";
	return $res;
}


function get_list_select($vals,$current_vals,$s_name,$cstyle='',$blank_value='',$language='') {

	$res = '<select name="'.$s_name.'" class="'.$cstyle.'">'."\n";
	$res .= '<option value=""> '.(!empty($blank_value) ? ucwords(str_replace("_"," ",$blank_value)) : '&#160;').' </option>'."\n";
		foreach($vals as $key => $value) { 
			//extract($value);
			//print_r($value);
			if($value['id'] == $current_vals) {
				$res .= '<option value="'.$value['id'].'" selected="selected">'
				.(!empty($language) && isset($value['name_'.$language]) && !empty($value['name_'.$language]) ? $value['name_'.$language] : ucwords(str_replace("_"," ",$value['name']))).
				'</option>'."\n";
				continue;
			}
			$res .= '<option value="'.$value['id'].'">'
			.(!empty($language) && isset($value['name_'.$language]) && !empty($value['name_'.$language]) ? $value['name_'.$language] : ucwords(str_replace("_"," ",$value['name']))).
			'</option>'."\n";
		}
	$res .= '</select>'."\n";
	return $res;
}

function get_list_checkbox($option,$values,$c_name,$cstyle='',$pageTotal) {
	$out = '<table width="100%" border="0" cellspacing="0" cellpadding="0"'.(!empty($cstyle) ? ' style="'.$cstyle.'"' : '').'><tr>';
		$n=0;
		foreach($option as $key => $value) {
		extract($value);
		//extract($values);

		$n++;
			(in_array($id,$values) ? $checked = 'checked="checked"' : $checked = '');
			$out .= '<td width="33%"><input type="checkbox" name ="'.$c_name.'" value="'.$id.'" '.$checked.' /> '.$name.'</td>';
			if($n % 3) {
			continue;
			} else {
				$out .= "</tr><tr>";
			}
		}
		$out .= '</table>';
	return $out;
}

function radio_YesNo($vals,$current_vals,$s_name,$s_id,$cstyle="") {
	$out = '';
	foreach($vals as $value=>$key) {  
		$checked = (($value == $current_vals) ? 'checked="checked"' : '');
	$out .= '
	<input type="radio" id="'.$s_id.'-'.$s_name.'-'.$value.'" name="'.$s_name.'" value="'.$value.'" '.$checked.' '.$cstyle.' />
	<label for="'.$s_id.'-'.$s_name.'-'.$value.'">'.$key.'</label>
	';
	}
	return $out;
}

function get_author_name($id) {
	$results = safeQuery("users","SELECT username, user_id FROM","WHERE user_id = '".$id."'");
	if ( $results ) {
		$item = mysql_fetch_object($results);
		$result = $item->username;
	} else {
		$result = '';
	}
	return $result;
}

function redirect_error_status($status) {
			switch($status) {
			case 403:
				$stat = 'HTTP/1.0 403 Forbidden';
				break;
			case 404:
				$stat = 'HTTP/1.0 404 File Not Found';
				break;
			default:
				$stat = 'HTTP/1.0 500 Internal Server Error';
				break;
			}
	if(!headers_sent()) {
		header($stat);
		exit;
	} else {
		print '<h4>'.$stat.'</h4>';
	}
}

function page_not_found($file) {
	$msg = '<div class="error"><h4>ERROR 404 [Object Not Found]</h4>';
	$msg .= '<p>The page <strong>'.$file.'</strong> can not be found.</p>';
	$msg .= '<p>Please contact administrator about this error.</p>';
	$msg .= '</div>';
	return $msg;
}

function imgOutput($img, $alt, $output = 'thumb') {
global $imgdir,$imgthumbdir,$thumb_ext;
	if( $output == 'thumb' ) {
		$fimg = $imgthumbdir . $thumb_ext . $img . '.jpg';
	} elseif( $output == 'actual' ) {
		$fimg = $imgdir . $img . '.jpg';
	}
	list($width, $height) = getimagesize($fimg);
	$out = '<img src="'.$fimg.'" width="'.$width.'" height="'.$height.'" alt="'.$alt.'" />';
	return $out;
}

function imgChk($img, $output = 'actual') {
global $imgdir,$imgNewItemdir,$imgthumbdir,$thumb_ext,$imgNewItem_ext;
	if( $output == 'thumb' ) {
		$fimg = $imgthumbdir . $thumb_ext . $img . '.jpg';
	} elseif( $output == 'actual' ) {
		$fimg = $imgdir . $img . '.jpg';
	} elseif( $output == 'new_img' ) {
		$fimg = $imgNewItemdir . $imgNewItem_ext . $img . '.jpg';
	}
	( file_exists($fimg) ) ? $out = 'Image Found' : $out = '<span class="red">Image Not Found</span>';
	return $out;
}

function popImgDetails($img,$alt,$custom = 0) {
global $imgdir;
	if($custom == 0) {
		list($width,$height) = getimagesize($imgdir.$img.'.jpg');
		$output_path = $imgdir.$img.'.jpg';
	} else {
		list($width,$height) = getimagesize($img);
		$output_path = $img;
	}
	//$result = 'popWindow(\'jpg\',\''.$output_path.'\',\''.$width.'\',\''.$height.'\',\''.SlashIt($alt).'\',\'10\',\'10\');';
	$result = "open('preview.php?id=$output_path', 'newWindow', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbar=auto,resizable=yes,copyhistory=no,width=$width,height=$height,left=10,top=10,screenX=10,screenY=10');";
	return $result;
}

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
	
	function unSlashIt($out)
	{
		return stripslashes($out);
	}
	
	function TagSC($out) 
	{
		return htmlspecialchars($out, ENT_QUOTES);
	}
	function TagEncode($out) 
	{
		return htmlentities($out, ENT_QUOTES, 'UTF-8');
	}
	
	function TagDecode($out) 
	{
		if( phpversion() >= 5) {
			return html_entity_decode($out, ENT_QUOTES, 'UTF-8');
		} else {
			return html_entity_decode($out, ENT_QUOTES);
		}
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
	function make_url($name) {
	include_once(PATH_CLASSES."/classTextile.php");
		$textile = new Textile();
		$title = $textile->TextileThis($name,1);
		$name = dumbDown($textile->TextileThis(trim(SlashIt($name)),1));
		$name = preg_replace("/[^[:alnum:]\-_]/", "", str_replace(" ","-",$name));
		return strtolower($name);
	}
	
	function build_url( $url, $protocols = null, $context = 'display' ) {
	$original_url = $url;

	if ('' == $url) return $url;
	$url = str_replace(" ","-",$url);
	$url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@]|i', '', $url);
	$strip = array('%0d', '%0a');
	$url = str_replace($strip, '', $url);
	$url = str_replace(';//', '://', $url);
	/* If the URL doesn't appear to contain a scheme, we
	 * presume it needs http:// appended (unless a relative
	 * link starting with / or a php file).
	*/
	if ( strpos($url, ':') === false &&
		substr( $url, 0, 1 ) != '/' && !preg_match('/^[a-z0-9-]+?\.php/i', $url) )
		$url =  $url;

	// Replace ampersands ony when displaying.
	if ( 'display' == $context )
		$url = preg_replace('/&([^#])(?![a-z]{2,8};)/', '&#038;$1', $url);

	return strtolower($url);
	}
// -------------------------------------------------------------------

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


function _status_error($code) {
	switch($code) {
		case '404':
			$output = '<p>Can not find module\'s component.</p>';
		break;
	}
	return $output;
}

function _redirect_page($url,$txt,$error = '') {
	if(!headers_sent()) 
	{
		switch($error) {
			case '301':
				header("HTTP/1.1 301 Moved Permanently"); 
			break;
			
			case '404':
				header("HTTP/1.0 404 Not Found"); 
			break;
		}
		if(!empty($url)) {
			header("Location: ".$url);
			exit;
		}
	} else {
		print '<h4>'.$txt.'. <a href="'.$url.'" title="Click here to continue">Click here to continue</a>.</h4>';
		return;
	}
}

function rteSafe($strText) {
	//returns safe code for preloading in the RTE
	$tmpString = $strText;
	
	//convert all types of single quotes
	$tmpString = str_replace(chr(145), chr(39), $tmpString);
	$tmpString = str_replace(chr(146), chr(39), $tmpString);
	$tmpString = str_replace("'", "&#39;", $tmpString);
	
	//convert all types of double quotes
	$tmpString = str_replace(chr(147), chr(34), $tmpString);
	$tmpString = str_replace(chr(148), chr(34), $tmpString);
//	$tmpString = str_replace("\"", "\"", $tmpString);
	
	//replace carriage returns & line feeds
	$tmpString = str_replace(chr(10), " ", $tmpString);
	$tmpString = str_replace(chr(13), " ", $tmpString);
	return $tmpString;
}

/**
	JavaScript Tool Tips 
	usage: js_tips($txt, $width, $color,$hint_txt,$gotourl);
**/
function js_tips($txt,$width='',$hint_txt='',$gotourl='') {
$width = (empty($width) ? 300 : $width);
$gotourl = (!empty($gotourl) ? $gotourl : 'javascript:void(0);');
$hint_txt = (!empty($hint_txt) ? $hint_txt : "?");
$out = '<a href="'.$gotourl.'" onmouseover="ddrivetip(\''.$txt.'\',\''.$width.'\',\'\');" onMouseout="hideddrivetip();">'.$hint_txt.'</a>';
	return $out;
}

/**
	JavaScript Window Open
	usage:  js_open_window($txt_output,$file,$width = 500,$height = 500);
**/
function js_open_window($txt_output,$file,$width = 500,$height = 500) {
	$out = '<a href="javascript:void(0)" onclick="open(\''.$file.'\', \'newWindow\', \'toolbar=no,location=no,directories=no,statusbar=yes,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width='.$width.',height='.$height.',left=20,top=20,screenX=10,screenY=10\');" title="Click here to Edit Images">'.$txt_output.'</a>';
	return $out;
}

function image_error_check($error_code,$file_name,$max_images_size_upload) {
	switch($error_code) {
		case 0: $out = ''; break;
		case 1: $out = 'Error: '.$file_name.' size exceed MAX FILE SIZE in ini.php'; break;
		case 2: $out = 'Error: '.$file_name.' size to big, exceed '.$max_images_size_upload; break;
		case 3: $out = 'Error: '.$file_name.' was only partially uploaded'; break;
		case 4: $out = 'Error: '.$file_name.' No file was uploaded'; break;
		case 6: $out = 'Error: '.$file_name.' can not find a temporary folder'; break;
		case 7: $out = 'Error: '.$file_name.' Failed to write file to disk'; break;
	}
	return $out;
}

function translate($const) {
global $selected_lang;
$language_file = (!isset($selected_lang) || empty($selected_lang) ? 'id' : $selected_lang);
	if(is_file(PATH_LANGUAGES.'/'.$language_file.'.php') && !@is_dir(PATH_LANGUAGES.'/'.$language_file.'.php')) {
		require_once(PATH_LANGUAGES.'/'.$language_file.'.php');
	} else {
		if(is_file(PATH_LANGUAGES.'/en.php') && !@is_dir(PATH_LANGUAGES.'/'.$language_file.'.php')) {
			require_once(PATH_LANGUAGES.'/en.php');
		}
	}
	if(defined($const)) {
		$get_const = constant($const);
		$out = ( !empty( $get_const ) ) ? constant($const) : $const;
	}
	if(!defined($const)) {
		$out = $const;
	}
	return $out;
}

function get_options($table,$field,$output='select',$cvalue='',$klausa='',$cstyle='',$bvalue='',$lang='',$formName='') {

	$table = 'TBL_'.strtoupper($table);
	$table = _PFX_.constant($table);
	$getType = safeQuery($table,"SELECT * FROM",$klausa);
	$pageTotal = mysql_num_rows($getType);
	$lang = (!empty($lang) ? '_'.$lang : '');
	if($pageTotal <= 0) {
		$out = 'no_'.$field.'_found';
	} else {
		$pageTotal = mysql_num_rows($getType);
		while($t = mysql_fetch_array($getType)) {
			
			$tArray[] = array(
			'id' => $t[$field.'_id'],
			'name' => $t[$field.'_name'],
			'name_'.$lang => $t[$field.'_name'.$lang]
			);
		}
		switch($output) {
			case 'checkbox':
			$cvalue = ($cvalue == '' ? array('vid' => '') : $cvalue);
			$out = get_list_checkbox($tArray,$cvalue,$field.'[]',$cstyle='',$pageTotal); 
			break;
			case 'select':
			//$cvalue = ($cvalue == '' ? '' : $cvalue);
			$out = get_list_select(
					$vals=$tArray,
					$current_vals=$cvalue,
					$s_name=(!empty($formName) ? $formName : $field),
					$cstyle='',
					$blank_value=$bvalue,
					$language=$lang
					);
			break;
		}
	}
	return $out;
}

function admin_critical_error($subject='',$msg='') {
extract($GLOBALS['prefs']);
	$headers = 'From: error@'.$site_domain.'' . "\r\n" .
    'Reply-To: no-reply@'.$site_domain.'' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

	$subject = (empty($subject) ? '[Subject Missing]' : $subject);
	if(empty($msg)) return;
	return mail($root_email, $subject, $msg, $headers);
}

function _display($file,$content=array()) {
	global $production_status;
	if(file_exists( load_theme . $file ) && !is_dir( load_theme . $file )) {
		$data = $content;
		include_once( load_theme . $file );
	} else {
		header('Status: 503 Service Unavailable');
		if($production_status == 'debug') {
			$msg = 'Can not load template file!'.$file;
			die( site_offline($stats=1,$msg) );
		} else {
			$msg = 'Can not load template file!';
			die( site_offline($stats=1,$msg) );
		}
	}
}

function _errorPage($status,$msg='') {
	global $header;
	header("HTTP/1.0 404 Not Found");
	$header['content'] = $msg;
	_display('notfound.php',$header);
	return;
}

function get_image_ext($type) {
	switch($type) {
		case 'image/gif': $out = '.gif'; break;
		case 'image/jpeg': $out = '.jpg'; break;
		case 'image/pjpeg': $out = '.jpg'; break;
		case 'image/png': $out= '.png'; break;
	}
	return (!isset($out) ? false : $out);
}

function select_country($country = '') {
$countries = 'Albania,Algeria,American Samoa,Andorra,Angola,Anguilla,Antigua and Barbuda,Argentina,Armenia,Aruba,Australia,Austria,Azerbajan,Azores (Portugal),Bahamas,Bahrain,Bangladesh,Barbados,Belarus,Belgium,Belize,Benin,Bermuda,Bolivia,Bonaire (Netherlands Antillies),Bosnia,Botswana,Brazil,British Virgin Islands,Brunei,Bulgaria,Burkina Faso,Burundi,Cambodia,Cameroon,Canada,Canary Islands,Cape Verde,Cayman Islands,Central African Republic,Chad,Channel Islands,Chile,China,Colombia,Congo - Democratic Republic of(Zaire),Congo - Republic of,Cook Islands,Costa Rica,Ivory Coast,Croatia,Curacao (Netherlands Antillies),Cyprus,Czech Republic,Denmark,Djibouti,Dominica,Dominican Republic,Ecuador,Egypt,El Salvador,England,Equatorial Guniea,Eritrea,Estonia,Ethiopia,Faroe Islands (Denmark),Fiji,Finland,France,French Guiana,French Polynesia,Gabon,Gambia,Georgia,Germany,Ghana,Gibraltar,Greece,Greenland (Denmark),Grenada,Guadeloupe,Guam,Guatemala,Guinea,Guinea-Bissau,Guyana,Haiti,Holland (Netherlands),Honduras,Hong Kong,Hungary,Iceland,India,Indonesia,Ireland - Republic Of,Israel,Italy,Jamaica,Japan,Jordan,Kazakhstan,Kenya,Kiribati,Korea (South Korea),Kosrae (Federated States of Micronesia),Kuwait,Kyrgyzstan,Laos,Latvia,Lebanon,Lesotho,Liberia,Liechtenstein,Lithuania,Luxembourg,Macau,Macedonia,Madagascar,Maderia (Portugal),Malawi,Malaysia,Maldives,Mali,Malta,Marshall Islands,Martinique,Mauritania,Mauritius,Mexico,Micronesia - Federated States of,Moldova,Monaco,Mongolia,Montserrat,Morocco,Mozambique,Namibia,Nepal,Netherlands (Holland),Netherlands Antilles,New Caledonia,New Zealand,Nicaragua,Niger,Nigeria,Norfolk Island,Northern Ireland (UK),Northern Mariana Islands,Norway,Oman,Pakistan,Palau,Panama,Papua New Guinea,Paraguay,Peru,Philippines,Poland,Ponape (Federated States of Micronesia+A193),Portugal,Puerto Rico,Qatar,Reunion,Romania,Rota (Northern Mariana Islands),Russia,Rwanda,Saba (Netherlands Antilles),Saipan (Northern Mariana Islands),San Marino,Saudi Arabia,Scotland (United Kingdom),Senegal,Seychelles,Sierra Leone,Singapore,Slovakia,Slovenia,Solomon Islands,South Africa,Spain,Sri Lanka,St. Barthelemy (Guadeloupe),St. Christopher (St. Kitts and Nevis),St. Croix (U.S. Virgin Islands),St. Eustatius (Netherlands Antilles),St. John (U.S. Virgin Islands),St. Kitts and Nevis,St. Lucia,St. Maarten (Netherlands Antilles),St. Martin (Guadeloupe),St. Thomas (U.S. Virgin Islands),St. Vincent and the Grenadines,Suriname,Swaziland,Sweden,Switzerland,Syria,Tahiti (French Polynesia),Taiwan,Tajikistan,Tanzania,Thailand,Tinian (Northern Mariana Islands),Togo,Tonga,Tortola (British Virgin Islands),Trinidad and Tobago,Truk (Federated States of Micronesia),Tunisia,Turkey,Turkmenistan,Turks and Caicos Islands,Tuvalu,U.S. Virgin Islands,Uganda,Ukraine,Union Island (St. Vincent and the Grenadines),United Arab Emirates,United Kingdom,United States,Uruguay,Uzbekistan,Vanuatu,Venezuela,Vietnam,Virgin Gorda (British Virgin Islands),Wake Island,Wales (United Kingdom),Wallis and Futuna Islands,Western Samoa,Yap (Federated States of Micronesia),Yemen,Yugoslavia,Zambia,Zimbabwe
';
	
	$res = '<select name="country"><option value=""> -- Select country -- </option>';
	foreach(explode(',', $countries) as $key) {
		if($key == $country) { 
			$selected = 'selected';
		} else {
			$selected = '';
		}
		$res .= '<option value="'.$key.'" '.$selected.'>'.$key.'</option>';
	}
	$res .= '</select>';
	return $res;
}

function trimExcerpt($text,$len=55) {
	global $post;
		$text = str_replace(']]>', ']]&gt;', $text);
		$text = strip_tags($text);
		$excerpt_length = $len;
		$words = explode(' ', $text, $excerpt_length + 1);
		if (count($words) > $excerpt_length) {
			array_pop($words);
			array_push($words, '...');
			$text = implode(' ', $words);
		}
	return $text;
}

function splitText($xstr, $xlenint, $xlaststr = '...')
{
    $texttoshow = chunk_split($xstr,$xlenint,"\r\n"); 
    $texttoshow  = split("\r\n",$texttoshow);
	$n = count($texttoshow);
	//print_r($texttoshow);
    $texttoshow = $texttoshow[0].($n <= 2 ? '' : $xlaststr);
    return $texttoshow;
}

function removeWhitespace($string)
{
    if (!is_string($string)) return false;

    $string = preg_quote($string, '|');
    return preg_replace('|  +|', ' ', $string);
}


/** Form - Dates Helper **/
function dateListBox($s_name,$c_vals,$blank_value='',$csClass='') {
	$out = '<select name="'.$s_name.'" id="'.$s_name.'" class="'.$csClass.'">'."\n";
	$out .= '<option value=""> '.(!empty($blank_value) ? ucwords(str_replace("_"," ",$blank_value)) : '&#160;').' </option>'."\n";
	for($tgl=1; $tgl <= 31;$tgl++) {
		$tglOutput = (strlen($tgl) == 2 ? $tgl : '0'.$tgl);
		$selected = ($tglOutput == $c_vals) ? ' selected="selected"' : '';
		$out .= '<option value="'.$tglOutput.'"'.$selected.'>'.$tglOutput.'</option>';
	}
	$out .= '</select>'."\n";
	return $out;
}

function monthListBox($s_name,$c_vals,$blank_value='',$csClass='') {
	$out = '<select name="'.$s_name.'" id="'.$s_name.'" class="'.$csClass.'">'."\n";
	$out .= '<option value=""> '.(!empty($blank_value) ? ucwords(str_replace("_"," ",$blank_value)) : '&#160;').' </option>'."\n";
	for($bln=1; $bln <= 12;$bln++) {
			$blnOutput = (strlen($bln) == 2 ? $bln : '0'.$bln);
			$bulan = array(
							'01' => 'January',
							'02' => 'February',
							'03' => 'March',
							'04' => 'April',
							'05' => 'May',
							'06' => 'June',
							'07' => 'July',
							'08' => 'August',
							'09' => 'September',
							'10' => 'October',
							'11' => 'November',
							'12' => 'December'							
						);
		$selectedm = ($blnOutput == $c_vals) ? ' selected="selected"' : '';
		$out .= '<option value="'.$blnOutput.'"'.$selectedm.'>'.$bulan[$blnOutput].'</option>';
		}
	$out .= '</select>'."\n";
	return $out;
}

function yearListBox($s_name,$yStart,$yEnd,$c_vals,$blank_value='',$csClass='') {
	$out = '<select name="'.$s_name.'" id="'.$s_name.'" class="'.$csClass.'">'."\n";
	$out .= '<option value=""> '.(!empty($blank_value) ? ucwords(str_replace("_"," ",$blank_value)) : '&#160;').' </option>'."\n";
	for($thn=$yStart;$thn <= $yEnd; $thn++) {
		$selectedy = ($thn == $c_vals) ? ' selected="selected"' : '';
		$out .= '<option value="'.$thn.'"'.$selectedy.'>'.$thn.'</option>';
	}
	$out .= '</select>'."\n";
	return $out;
}
?>