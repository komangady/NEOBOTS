<?php
function _status_error($code) {
	switch($code) {
		case '404':
			$output = '<p>Can not find module\'s component.</p>';
		break;
	}
	return $output;
}
?>