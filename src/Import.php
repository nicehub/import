<?php

namespace Nicehub\Import;

use Nicehub\Import\Interfaces\Modifier;
use Nicehub\Import\Interfaces\FieldRename as BaseRename;
use Nicehub\Import\Interfaces\Reader;
use Nicehub\Import\Interfaces\Writer;

class Import
{
    protected $reader;
    protected $writer;
    protected $fieldRename;
    protected $modifier;

    public function  __construct(Reader $reader, Writer $writer)
    {
        $this->reader = $reader;
        $this->writer = $writer;
    }

    public function setFieldRenamer(FieldRename $fieldRename)
    {
        $this->fieldRename = $fieldRename;
        return $this;
    }

    public function setModifier(Modifier $modifier)
    {
        $this->modifier = $modifier;
        return $this;
    }

    public function execute()
    {
        $report = new Report();
        while($row = $this->reader->fetchOne()) {
            if ($this->fieldRename instanceof BaseRename) {
                $row = $this->fieldRename->rename($row);
            }
            if ($this->modifier instanceof Modifier) {
                $row = $this->modifier->modify($row);
            }
            $entity = $this->writer->writeOne($row);
            $report->addInput($row);
            $report->addOutput($entity);
            $report->increment();
        }
        return $report;
    }
}