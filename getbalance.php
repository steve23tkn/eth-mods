<?php

require_once "vendor/autoload.php";

use Web3\Web3;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;

function GetBalance($address){
    $timeout = 10;
    $web3 = new Web3(new HttpProvider(new 
    HttpRequestManager("https://ropsten.infura.io/v3/b3593867c26d4c92add264fa5662fd36", $timeout)));
    
    $eth = $web3->eth;  

    $wei = "";
    
    $eth->getBalance($address, function ($err, $data) use (&$wei){

            if ($err != null){
                    print_r($err);
                    return;
            }
            echo "Balance is: ". $data . " \n";
            $wei = $data;
    });   

    if ($wei=="") return 0;

    $wei_gmp = $wei->value;
    $ether_gmp = gmp_div_qr($wei_gmp, "1000000000000000000");
    $ether_str = gmp_strval($ether_gmp[0]) . ".";
    $ether_str = $ether_str . substr(gmp_strval($ether_gmp[1]), 0, 8);
    return (float)$ether_str;
}

//$addr = "0x5ebbc22cdefb71b6d885ef9b1a30843edc3f29a0";
//$bal = GetBalance($addr);
//var_dump($bal);