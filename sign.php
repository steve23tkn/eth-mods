<?php 

require_once "vendor/autoload.php";

use kornrunner\Ethereum\Transaction;

$nonce    = '26'; // 
$gasPrice = '174876E800'; // 100 gwei -> 100 * 1e9
$gasLimit = '5208'; //_numToHex($gas) 21000 unit of gas
$to       = '0x3c5a29737e2c9219f1e1e8fb6e28c9c1e1db29ea';
$value    = '2386F26FC10000'; // _numToHex(eth2wei($value)) 0.01 * 1e18 -> 1e16 -> 
$chainId  = 3; // ROPSTEN

$privateKey = 'a0da8a9dd90749d4ee2bb460a6616ef87cb70da7317c15d50873983106b30e02';

$transaction = new Transaction ($nonce, $gasPrice, $gasLimit, $to, $value);
$signed_tx = $transaction->getRaw ($privateKey, $chainId);

var_dump($signed_tx);