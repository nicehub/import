<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Nicehub\Import\Readers\CsvReader;
use Nicehub\Import\Writers\WriterCallback;
use Nicehub\Import\Import;
use Nicehub\Import\FieldRename;

$filePath = __DIR__ . '/assets/basic.csv';

$file = new \SplFileObject($filePath);
$file->setCsvControl('~');
$reader = new CsvReader($file);
$renamer = new FieldRename([0 => 'name', 1 => 'price']);
$writer = new WriterCallback(function($data) {
    return json_encode($data);
});

$import = new Import($reader, $writer);
$report = $import->setFieldRenamer($renamer)->execute();

print '// report count value must be 3' . PHP_EOL;
print $report->count();
print_r($report->inputs());
print_r($report->outputs());