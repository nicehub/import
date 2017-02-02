<?php

namespace Nicehub\Import;

use Nicehub\Import\Readers\CsvReader;
use Nicehub\Import\Readers\XmlReader;
use Nicehub\Import\Writers\WriterCallback;

class WriterCallbackTest extends \PHPUnit_Framework_TestCase
{
    public function testWriteStdClass()
    {
        $std = new \StdClass();
        $std->name = 'Name 1';
        $std->type = 'Type 1';

        $row = [
            'name' => 'Name 1',
            'type' => 'Type 1'
        ];

        $writer = new WriterCallback(function($data) {
            return (object)$data;
        });

        $result = $writer->writeOne($row);

        $this->assertEquals($std, $result);
    }

    public function testWriteJson()
    {
        $json = '{"name":"Name 1","type":"Type 1"}';

        $row = [
            'name' => 'Name 1',
            'type' => 'Type 1'
        ];

        $writer = new WriterCallback(function($data) {
            return json_encode($data);
        });

        $result = $writer->writeOne($row);

        $this->assertEquals($json, $result);
    }
}