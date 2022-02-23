<?php

$input = "0xa9059cbb000000000000000000000000e55a17e44e7361d535d7dc9821494f9025d47ad7000000000000000000000000000000000000000000000000000000001bd5dac0";
$input = substr($input, 2);

$len = strlen($input);

if ($len %64 !=8){
    echo "invalid input length: $len" .PHP_EOL;
    return false;
}

$address_bytes = substr($input, 8, 64);
$value_bytes = substr($input, 72, 64);

// ADDRESS PARSER

preg_match('/[^0]/', $address_bytes, $match, PREG_OFFSET_CAPTURE);

if ( isset($match[0][1])==false ) {
    echo "decoding error array offset";
    return false;
}

$pos = $match[0][1];

$address = "0x" . substr($address_bytes, $pos, 42);

if ( strlen($address) % 2 > 0 ) {
    echo "invalid address hex length";
    return false;
}

//echo $address;

// VALUE PARSER

preg_match('/[^0]/', $value_bytes, $match, PREG_OFFSET_CAPTURE);

$value = '';

if ( $match!=[] ) {
    $pos = $match[0][1];
    $value_bytes = substr($value_bytes, $pos);
    $value_bytes = "0x" . $value_bytes;
    $value = hexdec($value_bytes);
}

echo $value;