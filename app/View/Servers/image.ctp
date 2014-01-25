<?php
//$image = imagecreatefromstring(base64_decode($data));
header('Content-Type: image/png');
fpassthru(base64_decode($data));
?>
