<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$img = imagecreatefromstring($data);
header('Content-Type: image/JPEG');
header("Content-Length: " . strlen($data));
imagejpeg($img);
?>
