<?php

namespace Nicehub\Import;

use Nicehub\Import\Converters\CallbackConverter;

class CallbackConverterTest extends \PHPUnit_Framework_TestCase
{
    protected $converter;

    public function setUp()
    {
        parent::setUp();

        $this->converter = new CallbackConverter(function($row) {
            $row['price'] = $row['price'] * 2;
            return $row;
        });

    }

    /** @test */
    public function convert()
    {
        $data = [
            'price' => 1200
        ];
        $equal = [
            'price' => 2400
        ];
        $this->converter->setField('price');
        $this->assertEquals($equal, $this->converter->convert($data));
    }

    /** @test */
    public function can_use_converted_value_stack()
    {
        $data = [
            'price' => 1200
        ];
        $equal = [
            'price' => 2400
        ];
        $this->converter->setField('price');
        $this->assertEquals($equal, $this->converter->convert($data));
        $this->assertEquals($equal, $this->converter->convert($data));
    }
}
