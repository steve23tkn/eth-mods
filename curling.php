<?php 

$ch = curl_init();

// set url 
curl_setopt($ch, CURLOPT_URL, "https://ropsten.infura.io/v3/b3593867c26d4c92add264fa5662fd36");
//curl_setopt($ch, CURLOPT_URL, "https://eth.getblock.io/testnet/");

// set user agent 
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

$data_array = array(
    "jsonrpc" => "2.0",
    //"method" => "parity_nextNonce",
    "method" => "eth_getTransactionCount",
    "params" => ["0x5ebbc22cdefb71b6d885ef9b1a30843edc3f29a0", "latest"],
    //"method" => "eth_blockNumber",
    //"params" => [],
    //"id" => 1
    "id" => "getblock.io"
);

$payload = json_encode($data_array);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

$headers = array(
    //"x-api-key: 'c9f563e5-57c8-4b00-8842-de0dac6b305e'", 
    "Content-Type: application/json"
);

//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// return the transfer a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// $output contains the output string
$output = curl_exec($ch);

$response = json_decode($output, true);

curl_close($ch);

var_dump($response["result"]);

