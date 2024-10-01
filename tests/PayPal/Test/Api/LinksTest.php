<?php

namespace PayPal\Test\Api;

use PayPal\Api\Links;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;

/**
 * Class Links
 *
 * @package PayPal\Test\Api
 */
class LinksTest extends TestCase
{
    /**
     * Gets Json String of Object Links
     * @return string
     */
    public static function getJson()
    {
        return '{"href":"TestSample","rel":"TestSample","target_schema":' .HyperSchemaTest::getJson() . ',"method":"TestSample","enctype":"TestSample","schema":' .HyperSchemaTest::getJson() . '}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return Links
     */
    public static function getObject()
    {
        return new Links(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return Links
     */
    public function testSerializationDeserialization()
    {
        $obj = new Links(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getHref());
        $this->assertNotNull($obj->getRel());
        $this->assertNotNull($obj->getTargetSchema());
        $this->assertNotNull($obj->getMethod());
        $this->assertNotNull($obj->getEnctype());
        $this->assertNotNull($obj->getSchema());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param Links $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals("TestSample", $obj->getHref());
        $this->assertEquals("TestSample", $obj->getRel());
        $this->assertEquals($obj->getTargetSchema(), HyperSchemaTest::getObject());
        $this->assertEquals("TestSample", $obj->getMethod());
        $this->assertEquals("TestSample", $obj->getEnctype());
        $this->assertEquals($obj->getSchema(), HyperSchemaTest::getObject());
    }
}
