<?php

namespace Nicehub\Import\Converters;

use Nicehub\Import\Interfaces\Converter;

class CallbackConverter extends BaseConverter implements Converter
{
    protected $closure;

    public function __construct(callable $closure)
    {
        $this->closure = $closure;
    }

    public function convert($array)
    {
        if (!$this->hasField()) {
            return $array;
        }

        $field = $this->getField();
        $parentResult = parent::convert($array);
        if ($parentResult[$field] != $array[$field]) {
            return $parentResult;
        }
        $result = call_user_func($this->closure, $parentResult);

        $this->linkValues($array[$field], $result[$field]);

        return $result;
    }
}