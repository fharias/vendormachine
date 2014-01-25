<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$image = sqlsrv_get_field( $data, 0, 
                      SQLSRV_PHPTYPE_STREAM(SQLSRV_ENC_BINARY));
header("Content-type: image/jpeg;");
fpassthru($image); 
?>

