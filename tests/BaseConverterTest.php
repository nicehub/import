<?php

namespace Nicehub\Import\Converters;

class BaseConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BaseConverter
     */
    protected $converter;
    
    public function setUp()
    {
        $this->converter = new BaseConverter();
    }
    
    /** @test */
    public function can_save_old_value()
    {
        $this->converter->linkValues(1200, 2400);

        $this->assertEquals(2400, $this->converter->getValueByOld(1200));
    }

    /** @test */
    public function get_value_by_old_throw_exception()
    {
        try {
            $this->converter->getValueByOld(1200);
        } catch (\Exception $e) {
            $this->assertTrue(true);
        }
        $this->fail();
    }

    /** @test */
    public function can_check_new_value_available_1()
    {
        $this->converter->linkValues(1200, 2400);

        $this->assertTrue($this->converter->hasValueByOld(1200));
    }

    /** @test */
    public function can_check_new_value_available_2()
    {
        $this->assertFalse($this->converter->hasValueByOld(1200));
    }

    /** @test */
    public function doesnot_convert_without_link_value()
    {
        $data = [
            'value' => 1200
        ];
        $this->assertEquals($data, $this->converter->convert($data));
    }

    /** @test */
    public function can_convert_with_link_value()
    {
        $this->converter->setField('value');
        $data = [
            'value' => 2400
        ];
        $this->converter->linkValues(1200, 2400);
        $this->assertEquals($data, $this->converter->convert([
            'value' => 1200
        ]));
    }

    /** @test */
    public function can_set_and_get_field()
    {
        $this->converter->setField('price');

        $this->assertEquals('price', $this->converter->getField());
    }

    /** @test */
    public function can_check_setable_field_true()
    {
        $this->converter->setField('price');

        $this->assertTrue($this->converter->hasField());
    }

    /** @test */
    public function can_check_setable_field_false()
    {
        $this->assertFalse($this->converter->hasField());
    }
}