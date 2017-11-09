<?php

namespace Nicehub\Import\Converters;

class BaseConverterTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function can_save_old_value()
    {
        $converter = $this->getMockForAbstractClass(BaseConverter::class);

        $converter->linkValues(1200, 2400);

        $this->assertEquals(2400, $converter->getValueByOld(1200));
    }

    /** @test */
    public function get_value_by_old_throw_exception()
    {
        $converter = $this->getMockForAbstractClass(BaseConverter::class);

        try {
            $converter->getValueByOld(1200);
        } catch (\Exception $e) {
            return $this->assertTrue(true);
        }
        $this->fail();
    }

    /** @test */
    public function can_check_new_value_available_1()
    {
        $converter = $this->getMockForAbstractClass(BaseConverter::class);

        $converter->linkValues(1200, 2400);

        $this->assertTrue($converter->hasValueByOld(1200));
    }

    /** @test */
    public function can_check_new_value_available_2()
    {
        $converter = $this->getMockForAbstractClass(BaseConverter::class);

        $this->assertFalse($converter->hasValueByOld(1200));
    }

    /** @test */
    public function doesnot_convert_without_link_value()
    {
        $converter = $this->getMockForAbstractClass(BaseConverter::class);

        $data = [
            'value' => 1200
        ];
        $this->assertEquals($data, $converter->convert($data));
    }

    /** @test */
    public function can_convert_with_link_value()
    {
        $converter = $this->getMockForAbstractClass(BaseConverter::class);
        $converter->setField('value');
        $data = [
            'value' => 2400
        ];
        $converter->linkValues(1200, 2400);
        $this->assertEquals($data, $converter->convert([
            'value' => 1200
        ]));
    }

    /** @test */
    public function can_set_and_get_field()
    {
        $converter = $this->getMockForAbstractClass(BaseConverter::class);

        $converter->setField('price');

        $this->assertEquals('price', $converter->getField());
    }

    /** @test */
    public function can_check_setable_field_true()
    {
        $converter = $this->getMockForAbstractClass(BaseConverter::class);

        $converter->setField('price');

        $this->assertTrue($converter->hasField());
    }

    /** @test */
    public function can_check_setable_field_false()
    {
        $converter = $this->getMockForAbstractClass(BaseConverter::class);

        $this->assertFalse($converter->hasField());
    }
}