<?php
function MyEncrypt($sData, $sKey='reageninteniipromise')
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
?>
