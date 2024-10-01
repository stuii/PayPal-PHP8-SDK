<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Api\Amount;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

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
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new Amount(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return Amount
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new Amount(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getCurrency());
        $this->assertNotNull($obj->getTotal());
        $this->assertNotNull($obj->getDetails());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param Amount $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals("TestSample", $obj->getCurrency());
        $this->assertEquals("12.34", $obj->getTotal());
        $this->assertEquals($obj->getDetails(), DetailsTest::getObject());
    }
}
