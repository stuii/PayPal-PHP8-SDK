<?php

namespace PayPal\Test\Api;

use PayPal\Api\Currency;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\TestCase;

/**
 * Class Currency
 *
 * @package PayPal\Test\Api
 */
class CurrencyTest extends TestCase
{
    /**
     * Gets Json String of Object Currency
     *
     * @return string
     */
    public static function getJson()
    {
        return '{"currency":"TestSample","value":"12.34"}';
    }

    /**
     * Gets Object Instance with Json data filled in
     *
     * @return Currency
     * @throws PayPalConfigurationException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public static function getObject()
    {
        return new Currency(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     *
     * @return Currency
     * @throws PayPalConfigurationException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new Currency(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getCurrency());
        $this->assertNotNull($obj->getValue());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param Currency $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getCurrency(), "TestSample");
        $this->assertEquals($obj->getValue(), "12.34");
    }
}
