<?php
/*** Database Configuration ***/
$dhost = '';
$duser = '';
$dbase = '';
$dpass = '';

$subdir = '/';
$upload_save_dir = 'istore/';
$upload_save_foto_admin = 'picadmin/';
$upload_save_foto_pegawai = 'picpegawai/';


$mdls = 'modules/';
$tmpl = 'templates/';
$images = 'images/';
$css = 'css/';
$js = 'js/';

$url = (isset($site_domain) && !empty($site_domain) ? $site_domain : $_SERVER['HTTP_HOST']);
$protocol = (@$_SERVER['HTTPS'] == 'on' || @$_SERVER['HTTPS'] == '1' ? 'https://' : 'http://');

if (!defined('protocol')) { define("protocol", $protocol); };
if (!defined('site_root')) { define("site_root", $protocol.$url.$subdir); };
if (!defined('DOCROOT')) { define('DOCROOT', $_SERVER['DOCUMENT_ROOT']); };
if (!defined('iStore')) { define('iStore', DOCROOT.$subdir.$upload_save_dir); };
if (!defined('iStoreLoad')) { define('iStoreLoad', $protocol.$url.$subdir.$upload_save_dir); };
if (!defined('picadmin')) { define('picadmin', DOCROOT.$subdir.$upload_save_foto_admin); };
if (!defined('picadminload')) { define('picadminload', $protocol.$url.$subdir.$upload_save_foto_admin); };

if (!defined('picpegawai')) { define('picpegawai', DOCROOT.$subdir.$upload_save_foto_pegawai); };
if (!defined('picpegawaiload')) { define('picpegawaiload', $protocol.$url.$subdir.$upload_save_foto_pegawai); };




?>
