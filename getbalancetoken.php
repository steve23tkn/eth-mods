<?php

require_once "vendor/autoload.php";

use Web3\Web3;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;
use Web3\Contract;

function GetBalance(){
    $precision = 18;
    $timeout = 10;
    $web3 = new Web3(new HttpProvider(new 
    HttpRequestManager("https://ropsten.infura.io/v3/b3593867c26d4c92add264fa5662fd36", $timeout)));

    $usdt_str = file_get_contents("usdt.json");

    $address = '0x44413e8ceefd8cb41e30aaef38daaa0dbecfeaa2';

    $contractAddress = '0x0c75f1a56d49b0da7c963451ef3dde931528fd35';

    $contract = new Contract($web3->provider, $usdt_str);

    $raw = gmp_init("123456");

    //var_dump($raw);

    $contract->at($contractAddress)->call('balanceOf', $address, function ($err, $data) use(&$raw) {
        if ($err != null){
                print_r($err);
                return;
        }

        //var_dump($data);
        $raw = $data['balance']->value;

        //echo "Balance is: ". $data . " \n";    
    });

    //var_dump(strval($raw));

    if ($raw==gmp_init("123456")) return -1;

    $bal_gmp = gmp_div_qr($raw, "1000000000000000000");
    $bal_str = gmp_strval($bal_gmp[0]) . ".";
    $bal_str = $bal_str . substr(gmp_strval($bal_gmp[1]), 0, $precision);
    return $bal_str;
}

//$bal = GetBalance();
//var_dump($bal);
