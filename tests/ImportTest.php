<?php

namespace Nicehub\Import;

use Nicehub\Import\Interfaces\Reader;
use Nicehub\Import\Interfaces\Writer;
use Nicehub\Import\Modifiers\Modifier;

class ImportTest extends \PHPUnit_Framework_TestCase
{
    protected $import;

    public function setUp()
    {
        parent::setUp();

        $reader = $this->getMockBuilder(Reader::class)
            ->getMockForAbstractClass();
        $reader->expects($this->at(0))
            ->method('fetchOne')
            ->willReturn(['id' => 1, 'name' => 'John']);
        $reader->expects($this->at(1))
            ->method('fetchOne')
            ->willReturn(['id' => 2, 'name' => 'Steven']);
        $reader->expects($this->at(2))
            ->method('fetchOne')
            ->willReturn(false);

        $writer = $this->getMockBuilder(Writer::class)
            ->getMockForAbstractClass();
        $this->import = new Import($reader, $writer);
    }

    public function testImport()
    {
        // act
        $result = $this->import->execute();

        // assert
        $this->assertEquals(2, $result->count());
    }

    public function testImportWithConverter()
    {
        // act
        $renamer = new FieldRename(['name' => 'first_name']);
        $this->import->setFieldRenamer($renamer);
        $report = $this->import->execute();

        // assert
        $equal = [
            ['id' => 1, 'first_name' => 'John'],
            ['id' => 2, 'first_name' => 'Steven']
        ];
        $this->assertEquals($equal, $report->inputs());
    }

    public function testImportWithModifier()
    {
        // act
        $modifier = new Modifier(['last_name' => 'Doe']);
        $this->import->setModifier($modifier);
        $report = $this->import->execute();

        // assert
        $equal = [
            ['id' => 1, 'name' => 'John', 'last_name' => 'Doe'],
            ['id' => 2, 'name' => 'Steven', 'last_name' => 'Doe']
        ];

        $this->assertEquals($equal, $report->inputs());
    }
}
