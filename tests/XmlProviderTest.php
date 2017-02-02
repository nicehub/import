<?php

namespace Nicehub\Import;

use Nicehub\Import\Readers\XmlReader;

class XmlProviderTest extends \PHPUnit_Framework_TestCase
{
    protected $provider;

    public function setUp()
    {
        parent::setUp();

        $xmlstr = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"><url><loc>http://test-site.com/articles/1</loc><lastmod>2016-11-07T00:00:00+00:00</lastmod></url><url><loc>http://test-site.com/articles/2</loc><lastmod>2016-11-07T00:00:00+00:00</lastmod></url></urlset>';

        $provider = new XmlReader();
        $provider->setXmlByString($xmlstr);
        $provider->setSelector('url');
        $this->provider = $provider;
    }

    public function testFetchOne()
    {
        $equal = [
            'loc' => 'http://test-site.com/articles/1',
            'lastmod' => '2016-11-07T00:00:00+00:00'
        ];
        $row = $this->provider->fetchOne();

        $this->assertEquals($equal, $row);

        $equal = [
            'loc' => 'http://test-site.com/articles/2',
            'lastmod' => '2016-11-07T00:00:00+00:00'
        ];
        $row = $this->provider->fetchOne();

        $this->assertEquals($equal, $row);
        $row = $this->provider->fetchOne();
        $this->assertFalse($row);
    }
}
