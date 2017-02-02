<?php

namespace Nicehub\Import;

class FieldRenameTest extends \PHPUnit_Framework_TestCase
{
    protected $converter;

    public function setUp()
    {
        parent::setUp();

        $converterRules = [
            'title' => 'name',
            'price_orig' => 'price'
        ];
        $this->converter = new FieldRename($converterRules);

    }

    public function testConvert()
    {
        // arrange
        $data = [
            'title' => 'Name 1',
            'price_orig' => 1200
        ];
        // assert
        $equal = [
            'name' => 'Name 1',
            'price' => 1200
        ];
        $this->assertEquals($equal, $this->converter->rename($data));
    }

    public function testConvertBiggerArray()
    {
        // arrange
        $data = [
            'title' => 'Name 1',
            'price_orig' => 1200,
            'count' => 2
        ];
        // assert
        $equal = [
            'name' => 'Name 1',
            'price' => 1200,
            'count' => 2
        ];
        $this->assertEquals($equal, $this->converter->rename($data));
    }
}
