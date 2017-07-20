<?php

namespace Nicehub\Import\Readers;

use Nicehub\Import\Interfaces\Reader;

/**
 * @todo Extend the exception
 * @todo Add selector items
 * Class XmlReader
 * @package Nicehub\Import\Readers
 */
class XmlReader implements Reader
{
    protected $data;
    protected $xml;
    protected $selector;

    public function fetchOne()
    {
        $this->hasData();

        $row = current($this->data);
        next($this->data);
        return $row;
    }

    public function fetchAll()
    {
        $this->hasData();
        return $this->data;
    }

    public function setSelector($selector)
    {
        $this->selector = $selector;
    }

    protected function hasData()
    {
        if (empty($this->data)) {
            $this->data = $this->getData();
        }

        $this->getDataBySelector();
    }

    protected function getData()
    {
        $xml = $this->parseXml();
        return json_decode(json_encode($xml), true);
    }

    protected function parseXml()
    {
        if (empty($this->xml)) {
            // TODO extended
            throw new \Exception('Could not found xml string, please set xml data before parse');
        }

        if (($xml = simplexml_load_string($this->xml)) === false) {
            // TODO extended
            throw new \Exception('Error parse xml');
        }

        return $xml;
    }

    public function setXmlByPath($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, $url);
        $result = curl_exec($curl);
        curl_close($curl);
        $this->xml = $result;
    }

    public function setXmlByString($xml_string)
    {
        $this->xml = $xml_string;
    }

    public function getDataBySelector()
    {
        if (!$this->selector) {
            return;
        }
        $selector = explode('.', $this->selector);
        $data = $this->data;
        foreach ($selector as $key) {
            if (!isset($data[$key])) {
                return;
            }
            $data = $data[$key];
        }

        $this->data = $data;
    }
}