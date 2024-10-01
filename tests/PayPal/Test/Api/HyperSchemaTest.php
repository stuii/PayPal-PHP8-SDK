<?php

namespace PayPal\Test\Api;

use PayPal\Api\HyperSchema;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;

/**
 * Class HyperSchema
 *
 * @package PayPal\Test\Api
 */
class HyperSchemaTest extends TestCase
{
    /**
     * Gets Json String of Object HyperSchema
     * @return string
     */
    public static function getJson()
    {
        return '{"fragment_resolution":"TestSample","readonly":true,"content_encoding":"TestSample","path_start":"TestSample","media_type":"TestSample"}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return HyperSchema
     */
    public static function getObject()
    {
        return new HyperSchema(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return HyperSchema
     */
    public function testSerializationDeserialization()
    {
        $obj = new HyperSchema(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getFragmentResolution());
        $this->assertNotNull($obj->getReadonly());
        $this->assertNotNull($obj->getContentEncoding());
        $this->assertNotNull($obj->getPathStart());
        $this->assertNotNull($obj->getMediaType());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param HyperSchema $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals("TestSample", $obj->getFragmentResolution());
        $this->assertEquals(true, $obj->getReadonly());
        $this->assertEquals("TestSample", $obj->getContentEncoding());
        $this->assertEquals("TestSample", $obj->getPathStart());
        $this->assertEquals("TestSample", $obj->getMediaType());
    }
}
