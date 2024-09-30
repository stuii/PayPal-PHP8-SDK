<?php

namespace PayPal\Test\Api;

use PayPal\Api\Amount;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\TestCase;

/**
 * Class Amount
 *
 * @package PayPal\Test\Api
 */
class AmountTest extends TestCase
{
    /**
     * Gets Json String of Object Amount
     * @return string
     */
    public static function getJson()
    {
        return '{"currency":"TestSample","total":"12.34","details":' . DetailsTest::getJson() . '}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return Amount
     * @throws PayPalConfigurationException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public static function getObject()
    {
        return new Amount(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return Amount
     * @throws PayPalConfigurationException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new Amount(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getCurrency());
        $this->assertNotNull($obj->getTotal());
        $this->assertNotNull($obj->getDetails());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param Amount $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getCurrency(), "TestSample");
        $this->assertEquals($obj->getTotal(), "12.34");
        $this->assertEquals($obj->getDetails(), DetailsTest::getObject());
    }
}
