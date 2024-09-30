<?php

namespace PayPal\Test\Api;

use PayPal\Common\PayPalModel;
use PayPal\Api\Patch;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\TestCase;

/**
 * Class Patch
 *
 * @package PayPal\Test\Api
 */
class PatchTest extends TestCase
{
    /**
     * Gets Json String of Object Patch
     * @return string
     */
    public static function getJson()
    {
        return '{"op":"TestSample","path":"TestSample","value":"TestSample","from":"TestSample"}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return Patch
     * @throws PayPalConfigurationException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public static function getObject()
    {
        return new Patch(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return Patch
     * @throws PayPalConfigurationException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new Patch(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getOp());
        $this->assertNotNull($obj->getPath());
        $this->assertNotNull($obj->getValue());
        $this->assertNotNull($obj->getFrom());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param Patch $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getOp(), "TestSample");
        $this->assertEquals($obj->getPath(), "TestSample");
        $this->assertEquals($obj->getValue(), "TestSample");
        $this->assertEquals($obj->getFrom(), "TestSample");
    }


}
