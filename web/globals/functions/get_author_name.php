<?php
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
?>