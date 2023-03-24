<?php
function removeWhitespace($string)
{
    if (!is_string($string)) return false;

    $string = preg_quote($string, '|');
    return preg_replace('|  +|', ' ', $string);
}
?>