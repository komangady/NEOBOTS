<?php
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
?>