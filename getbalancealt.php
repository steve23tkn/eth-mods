<?php

require_once "vendor/autoload.php";

function GetBalance($address){
    $ch = curl_init();

    // set url 
    curl_setopt($ch, CURLOPT_URL, "https://ropsten.infura.io/v3/b3593867c26d4c92add264fa5662fd36");
    
    // set user agent 
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    
    $data_array = array(
        "jsonrpc" => "2.0",
        "method" => "eth_getBalance",
        "params" => [$address, "latest"],
        "id" => ""
    );
    
    $payload = json_encode($data_array);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    
    $headers = array( 
        "Content-Type: application/json"
    );
    
    //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    // return the transfer a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    // $output contains the output string
    $output = curl_exec($ch);
    curl_close($ch);
    
    // response handling
    $response = json_decode($output, true);

    if (isset($response["error"])) return -1;

    var_dump($response);
    
    // convert to dec
    $decimal = hexdec($response["result"]);

    return $decimal;    
}

$addr = "0x5ebbc22cdefb71b6d885ef9b1a30843edc3f29a0";
$bal = GetBalance($addr);
var_dump($bal);