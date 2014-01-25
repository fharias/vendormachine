<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-Type: image/jpeg");
header("Content-Disposition:inline; filename=\"" . trim(htmlentities("image.jpg")) . "\"");
header("Content-Description: " . trim(htmlentities("image.jpg")));
header("Content-Length: " . (string)$data);
header("Connection: close");
 
echo base64_decode($data); 
?>

