<?php

namespace PayPal\Test\Api;

use PayPal\Api\FmfDetails;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\TestCase;

/**
 * Class FmfDetails
 *
 * @package PayPal\Test\Api
 */
class FmfDetailsTest extends TestCase
{
    /**
     * Gets Json String of Object FmfDetails
     * @return string
     */
    public static function getJson()
    {
        return '{"filter_type":"TestSample","filter_id":"TestSample","name":"TestSample","description":"TestSample"}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return FmfDetails
     * @throws PayPalConfigurationException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public static function getObject()
    {
        return new FmfDetails(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return FmfDetails
     * @throws PayPalConfigurationException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new FmfDetails(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getFilterType());
        $this->assertNotNull($obj->getFilterId());
        $this->assertNotNull($obj->getName());
        $this->assertNotNull($obj->getDescription());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param FmfDetails $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getFilterType(), "TestSample");
        $this->assertEquals($obj->getFilterId(), "TestSample");
        $this->assertEquals($obj->getName(), "TestSample");
        $this->assertEquals($obj->getDescription(), "TestSample");
    }
}
