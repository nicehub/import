<?php

namespace Nicehub\Import\Modifiers;

use Nicehub\Import\Interfaces\Modifier as BaseModifier;

/**
 * @todo Extended the Exception
 * Class Modifier
 * @package Nicehub\Import\Modifiers
 */
class Modifier implements BaseModifier
{
    protected $data;

    public function __construct($data)
    {
        $this->validate($data);
        $this->data = $data;
    }

    public function modify($data)
    {
        $this->validate($data);
        return array_merge($this->data, $data);
    }

    protected function validate($data)
    {
        if (!is_array($data)) {
            throw new \Exception('Data variable not type array');
        }
    }
}