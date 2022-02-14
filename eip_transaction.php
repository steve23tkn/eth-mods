<?php 

use Web3p\EthereumTx\EIP1559Transaction;

// generate transaction instance with transaction parameters
$transaction = new EIP1559Transaction([
'nonce' => '0x01',
'from' => '0xb60e8dd61c5d32be8058bb8eb970870f07233155',
'to' => '0xd46e8dd67c5d32be8058bb8eb970870f07244567',
'maxPriorityFeePerGas' => '0x9184e72a000',
'maxFeePerGas' => '0x9184e72a000',
'gas' => '0x76c0',
'value' => '0x9184e72a',
'chainId' => 1, // required
'accessList' => [],
'data' => '0xd46e8dd67c5d32be8d46e8dd67c5d32be8058bb8eb970870f072445675058bb8eb970870f072445675'
]);

$signedTransaction = $transaction->sign('a0da8a9dd90749d4ee2bb460a6616ef87cb70da7317c15d50873983106b30e02');
var_dump($signedTransaction);

// $timeout = 10;
// $web3 = new Web3(new HttpProvider(new HttpRequestManager("https://ropsten.infura.io/v3/b3593867c26d4c92add264fa5662fd36", $timeout)));

// $eth = $web3->eth;

// $eth->sendRawTransaction('0x' . $signedTransaction, function ($err, $data) {

//     if ($err != null){
//             print_r($err);
//             return;
//     }


//     echo "Tx: ". $data . " \n";
// });