<?php

require_once "vendor/autoload.php";

use Web3\Web3;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;

function GetBalance(){

    $timeout = 10;
    $web3 = new Web3(new HttpProvider(new 
    HttpRequestManager("https://ropsten.infura.io/v3/b3593867c26d4c92add264fa5662fd36", $timeout)));
    $eth = $web3->eth; 
    
    $block_no = "0xB723B9";

    $result = "";
    
    $eth->getBlockByNumber($block_no, true, function ($err, $data) use (&$result){

            if ($err != null){
                    print_r($err);
                    return;
            }

            var_dump($data);
            
            $result = $data;
    });   

    var_dump($result);


}

GetBalance();