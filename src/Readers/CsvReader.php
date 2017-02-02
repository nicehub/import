<?php

namespace Nicehub\Import\Readers;

use Nicehub\Import\Interfaces\Reader;

/**
 * @todo Extend the exception
 * @todo Add selector items
 * Class XmlReader
 * @package Nicehub\Import\Readers
 */
class CsvReader implements Reader
{
    protected $file;

    public function __construct(\SplFileObject $file)
    {
        $this->file = $file;
    }

    public function fetchOne()
    {
        if (!$this->file->eof()) {
            return $this->file->fgetcsv();
        } else {
            return false;
        }
    }
}