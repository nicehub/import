<?php

namespace Nicehub\Import;

class Report
{
    protected $count;
    protected $inputs;
    protected $outputs;

    public function __construct()
    {
        $this->count = 0;
        $this->items = [];
    }

    public function addInput($input)
    {
        $this->inputs[] = $input;
    }

    public function addOutput($output)
    {
        $this->outputs[] = $output;
    }

    public function count()
    {
        return $this->count;
    }

    public function increment()
    {
        ++$this->count;
    }

    public function inputs()
    {
        return $this->inputs;
    }

    public function outputs()
    {
        return $this->outputs;
    }
}