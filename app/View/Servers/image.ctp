<?php
$image = imagecreatefromstring($data);
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
?>
