<?php

namespace Nicehub\Import;

use Nicehub\Import\Readers\CsvReader;
use Nicehub\Import\Readers\XmlReader;

class CsvProviderTest extends \PHPUnit_Framework_TestCase
{
    protected $provider;

    public function setUp()
    {
        parent::setUp();

        $filePath = __DIR__ . '/assets/test.csv';

        $file = new \SplFileObject($filePath);
        $this->provider = new CsvReader($file);
    }

    public function testFetchOne()
    {
        $equal = [
            '0' => 'test1'
        ];
        $row = $this->provider->fetchOne();

        $this->assertEquals($equal, $row);

        $equal = [
            '0' => 'test2'
        ];
        $row = $this->provider->fetchOne();

        $this->assertEquals($equal, $row);
        $row = $this->provider->fetchOne();
        $this->assertFalse($row);
    }
}