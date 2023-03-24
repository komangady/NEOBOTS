<?php 
function strip_tags_content($str, $repto = NULL)  { 

	//** Return if string not given or empty.
    if (!is_string ($str)
        || trim ($str) == '')
            return $str;

    //** Recursive empty HTML tags.
    return preg_replace (

        //** Pattern written by Junaid Atari.
        '/<([^<\/>]*)>([\s]*?|(?R))<\/\1>/imsU',

        //** Replace with nothing if string empty.
        !is_string ($repto) ? '' : $repto,

        //** Source string
        $str
    );

} 
?> 