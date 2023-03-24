<?php
function splitText($xstr, $xlenint, $xlaststr = '...')
{
    $texttoshow = @chunk_split($xstr,$xlenint,"\r\n"); 
    $texttoshow  = @split("\r\n",$texttoshow);
	 $n = count($texttoshow);
	//print_r($texttoshow);
    $texttoshow = $texttoshow[0].($n <= 2 ? '' : $xlaststr);
    return $texttoshow;
}
?>