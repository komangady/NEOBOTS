<?php
function MyDecode_base64($sData)
{
  $sBase64 = strtr($sData, '-_', '+/');

  return base64_decode($sBase64);
}
?>