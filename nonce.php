<?php

require_once "vendor/autoload.php";

use Web3\Web3;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;

$timeout = 10;
$web3 = new Web3(new HttpProvider(new HttpRequestManager("https://ropsten.infura.io/v3/b3593867c26d4c92add264fa5662fd36", $timeout)));

$eth = $web3->eth;

// $eth->getTransactionCount("0x44413e8CEefd8cB41E30aaeF38dAaA0DBEcFEAa2", 11806461, function ($err, $data) {

//         if ($err != null){
//                 print_r($err);
//                 return;
//         }


//         echo "Data: ". $data . " \n";
// });