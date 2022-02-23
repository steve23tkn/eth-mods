<?php

require_once "vendor/autoload.php";

use Web3p\EthereumTx\Transaction;

use Web3\Web3;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;

function GetNonce($address){
    $ch = curl_init();

    // set url 
    curl_setopt($ch, CURLOPT_URL, "https://ropsten.infura.io/v3/b3593867c26d4c92add264fa5662fd36");
    
    // set user agent 
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    
    $data_array = array(
        "jsonrpc" => "2.0",
        "method" => "eth_getTransactionCount",
        "params" => [$address, "latest"],
        "id" => "getblock.io"
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
    
    $response = json_decode($output, true);
    
    curl_close($ch);
    
    return $response["result"];    
}

function ManualTransfer(){
    // generate transaction instance with transaction parameters

    $sender = '0x5EBbc22Cdefb71b6D885EF9B1a30843eDC3F29A0';
    $nonce = GetNonce($sender);

    var_dump($nonce);

    $transaction = new Transaction([
        'nonce' => $nonce,
        'from' => $sender,
        'to' => '0x3c5a29737e2c9219f1e1e8fb6e28c9c1e1db29ea',
        'gas' => '0x5208',
        'gasPrice' => '0x174876E800', // 100 gwei -> 100 * 1e9
        'value' => '0x2386F26FC10000', // _numToHex(eth2wei($value)) 0.01 * 1e18 -> 1e16 -> 
        'chainId' => 3, // optional
        'data' => ''
    ]);

    $signedTransaction = $transaction->sign('a0da8a9dd90749d4ee2bb460a6616ef87cb70da7317c15d50873983106b30e02');
    var_dump($signedTransaction);

    $timeout = 10;
    $web3 = new Web3(new HttpProvider(new HttpRequestManager("https://ropsten.infura.io/v3/b3593867c26d4c92add264fa5662fd36", $timeout)));

    $eth = $web3->eth;

    $result = "";

    $eth->sendRawTransaction('0x' . $signedTransaction, function ($err, $data) use (&$result){

        if ($err != null){
                print_r($err);
                return;
        }

        $result = $data;

        echo "Tx: ". $data . " \n";
    });

    var_dump($result);
}

ManualTransfer();

