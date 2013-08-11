<?php
 
header('content-type: image/png');
 $url = 'http://chart.googleapis.com/chart';
 
// Add image type, image size, and data to params.
 $qrcode = array(
 'cht' => 'qr',
 'chs' => '150x150',
 'chl' => $_REQUEST['q']);
 
// Send the request, and print out the returned bytes.
 $context = stream_context_create(
 array('http' => array(
 'method' => 'POST',
 'content' => http_build_query($qrcode))));
 fpassthru(fopen($url, 'r', false, $context));
 
?>