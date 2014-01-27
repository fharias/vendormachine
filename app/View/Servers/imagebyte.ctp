<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//file_put_contents('img/'.$iac.'.png', base64_decode($data));
 /*header('Content-Type: image/jpeg');
 header("Content-Length: " . strlen(base64_decode($data)));
 echo base64_decode($data);*/
$data = 'iVBORw0KGgoAAAANSUhEUgAAABwAAAASAQMAAAByySynAAAABlBMVEUAAAD///+l2Z/dAAAAP0lEQVQImWNgPm9gwAAmbM4bH4AQzAdAYiDC/rzxByTi/+f/cIL';
    $data = base64_decode($data);
    header('Content-Type: image/png');
    echo $data;
?>
