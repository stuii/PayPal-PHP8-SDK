<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Api\FmfDetails;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

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
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new FmfDetails(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return FmfDetails
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new FmfDetails(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getFilterType());
        $this->assertNotNull($obj->getFilterId());
        $this->assertNotNull($obj->getName());
        $this->assertNotNull($obj->getDescription());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param FmfDetails $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals("TestSample", $obj->getFilterType());
        $this->assertEquals("TestSample", $obj->getFilterId());
        $this->assertEquals("TestSample", $obj->getName());
        $this->assertEquals("TestSample", $obj->getDescription());
    }
}
