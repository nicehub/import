<?php

namespace Nicehub\Import;

use Nicehub\Import\Interfaces\FieldRename as BaseRename;

class FieldRename implements BaseRename
{
    protected $rules;

    public function __construct($rules)
    {
        $this->rules = $rules;
    }

    public function rename($data)
    {
        $output = [];
        foreach ($data as $key => $value) {
            if (!empty($this->rules[$key])) {
                $key = $this->rules[$key];
            }

            $output[$key] = $value;
        }
        return $output;
    }
}