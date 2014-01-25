<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
header("Content-type: image/jpeg;");
header('Transfer-Encoding-Type: base64');
header("Content-Disposition: inline; filename=item");
echo base64_encode($data); 
?>

