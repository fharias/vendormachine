<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

header('Content-Type: image/JPEG');
header("Content-Length: " . strlen($data));
$image = "";
foreach($data as $b){
    $image .= $b;
}
$img = imagecreatefromstring($image);
imagejpeg($img);
?>
