<?php

require_once "vendor/autoload.php";

use Web3\Web3;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;

$timeout = 10;
$web3 = new Web3(new HttpProvider(new HttpRequestManager("https://ropsten.infura.io/v3/b3593867c26d4c92add264fa5662fd36", $timeout)));

$eth = $web3->eth;

// $eth->getBalance("0x5EBbc22Cdefb71b6D885EF9B1a30843eDC3F29A0", function ($err, $data) {

//         if ($err != null){
//                 print_r($err);
//                 return;
//         }


//         echo "Balance is: ". $data . " \n";
// });

$eth->blockNumber(function ($err, $data) {

        if ($err != null){
                print_r($err);
                return;
        }

        var_dump(strval($data->value));

        echo "block number: ". $data . " \n";
});