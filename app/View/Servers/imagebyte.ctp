<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

header('Content-Type: image/JPEG');
header("Content-Length: " . strlen($data));
$img = imagecreatefromstring($data);
imagejpeg($img);
?>
