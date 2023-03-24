<?php
function resize_image($newWidth, $targetFile, $originalFile)
{   $img = imagecreatefromjpeg($originalFile);
    list($width, $height) = getimagesize($originalFile);
    $newHeight = ($height / $width) * $newWidth;
    $tmp = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    if (file_exists($targetFile)) {unlink($targetFile);}
    imagejpeg($tmp, $targetFile);
}
?>