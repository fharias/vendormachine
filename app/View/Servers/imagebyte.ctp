<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//file_put_contents('img/'.$iac.'.png', base64_decode($data));
 $im = imagecreatefromstring(base64_decode($data));
 imagepng($im);
?>
