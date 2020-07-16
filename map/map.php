<?php
$header = array('Authorization: Basic YWZlbGlwZXRydWppbGxvOkt1c2tpczEwMTM1OTk2MzU=');
$ch = curl_init("https://kc.kobotoolbox.org/api/v1/forms/465127.csv");
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$response = curl_exec($ch);
var_dump($response);
curl_close($ch);
