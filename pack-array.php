<?php

function __($s)
{
    return $s;
}

$data = require __DIR__ . '/data/apiKeys.php';

/*
$tmp = array_keys($data);

$reference = array_keys($data[$tmp[0]]);

foreach ($data as $key => $value) {
    echo $key . "\n";
    foreach (array_keys($value) as $test) {
        if (!in_array($test, $reference, true)) {
            echo '    ' . $test . "\n";
        }
    }
}
*/



//$keys = array_keys($data);
//
//$test = $data[$keys[0]];
//
//foreach ($data as $type => $typeData) {
//    $newTest = array();
//
//    foreach ($test as $key => $value) {
//        if (isset($typeData[$key]) && $typeData[$key] === $value) {
//            $newTest[$key] = $value;
//        }
//    }
//
//    $test = $newTest;
//}

$keys = array_keys($data);

$test = $data[$keys[0]];

foreach ($data as $type => $typeData) {
    $newTest = array();

    foreach ($test as $key => $value) {
        if (!isset($typeData[$key]) || $typeData[$key] === $value) {
            $newTest[$key] = $value;
        }
    }

    $test = $newTest;
}

$baseElements = var_export($test);
