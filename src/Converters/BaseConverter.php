<?php

namespace Nicehub\Import\Converters;

use Nicehub\Import\Interfaces\Converter;

class BaseConverter implements Converter
{
    protected $convertedValues = [];
    protected $field;

    public function convert($array)
    {
        if (!$this->hasField()) {
            return $array;
        }
        $oldValue = $array[$this->getField()];
        try {
            $array[$this->getField()] = $this->getValueByOld($oldValue);
        } catch (\Exception $e) {
        }
        return $array;
    }

    public function linkValues($oldValue, $newValue)
    {
        $this->convertedValues[$oldValue] = $newValue;
    }

    public function getValueByOld($oldValue)
    {
        if (!$this->hasValueByOld($oldValue)) {
            throw new \Exception();
        }
        return $this->convertedValues[$oldValue];
    }

    public function hasValueByOld($oldValue)
    {
        return array_key_exists($oldValue, $this->convertedValues);
    }

    public function setField($fieldName)
    {
        $this->field = $fieldName;
        return $this;
    }

    public function getField()
    {
        return $this->field;
    }

    public function hasField()
    {
        return !empty($this->field);
    }
}