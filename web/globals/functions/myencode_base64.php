<?php
function MyEncode_base64($sData)
{
  $sBase64 = base64_encode($sData);

  return strtr($sBase64, '+/', '-_');
}

?>