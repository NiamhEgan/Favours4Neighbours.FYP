<?php

namespace App\Helpers;

function transformObjectArrayWithNullValue($objectArray, $objectKeyName, $objectValueName)
{
    $dataArray = [];
    $dataArray[""] = "";
    foreach ($objectArray as $objectItem) {
        $key = $objectItem[$objectKeyName];
        $dataArray[$key] = $objectItem[$objectValueName];
    }
    return $dataArray;
}
