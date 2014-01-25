<?php
$image = imagecreatefromstring(base64_decode($data));
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
?>
