<?php

function geocode($adress){
    
    
$ad = urlencode($adress);
$apiKey = "AIzaSyDTbCZbT3cIAfDu1fzsvA6TIvs1Q6hisjk";
    
$url = "https://maps.googleapis.com/maps/api/geocode/json?sensor=false&address=".$ad."&key=".$apiKey;

$client = curl_init();
curl_setopt($client, CURLOPT_URL, $url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($client);
//$http_status = curl_getinfo($client, CURLINFO_HTTP_CODE);
curl_close($client);
    
$result = json_decode($response, true);
    
return $result;
    
}


?>