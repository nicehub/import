<?php

namespace Nicehub\Import\Writers;

use Nicehub\Import\Interfaces\Writer;

class WriterCallback implements Writer
{
    protected $closure;

    public function __construct(\Closure $closure)
    {
        $this->closure = $closure;
    }

    public function writeOne($data)
    {
        return $this->closure->__invoke($data);
    }
}