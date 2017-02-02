<?php

namespace Nicehub\Import;

use Nicehub\Import\Modifiers\Modifier;

/**
 * Class ModifierTest
 * @package Nicehub\Import
 */
class ModifierTest extends \PHPUnit_Framework_TestCase
{
    protected $modifier;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $modifier = new Modifier(['site_id' => 3]);
        $this->modifier = $modifier;
    }

    public function testModify()
    {
        $data = ['url' => 'articles/1'];
        $data = $this->modifier->modify($data);

        $equal = [
            'site_id' => 3,
            'url' => 'articles/1'
        ];
        $this->assertEquals($equal, $data);
    }

}