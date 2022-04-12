<?php

use Models\DataSet;

/** @var DataSet $model */

$field_set = $model->getFieldset();
ksort($field_set);

/**
 * Just minifying a code duplication
 *
 * @param array $field_set
 * @return string
 */
function twistedLine ($field_set) {
    $line = '=';
    foreach ($field_set as $size) {
        $line .= str_repeat('=', $size + 3);
    }
    return $line;
}

if (count($model->getSrcDataSet())) {

    // header
    print twistedLine ($field_set) . PHP_EOL;
    print '|';
    foreach ($field_set as $title => $size) {
        printf(' %'.$size.'s |', $title);
    }
    print PHP_EOL;
    print twistedLine ($field_set) . PHP_EOL;

    // data output
    $data_set = $model->getFieldset();
    for ($i = 0; $i < count($model->getSrcDataSet()); $i++) {
        $entry = $model->getEntryByIndex($i);
        print '|';
        foreach ($field_set as $key => $size) {
            printf(' %'.$size.'s |', $entry[$key]);
        }
        print PHP_EOL;
    }

    // footer line
    print twistedLine ($field_set) . PHP_EOL;

} else {

    print '=======================' . PHP_EOL;
    print '| No data for display |' . PHP_EOL;
    print '=======================' . PHP_EOL;

}



