<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Api\ShippingAddress;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class ShippingAddress
 *
 * @package PayPal\Test\Api
 */
class ShippingAddressTest extends TestCase
{
    /**
     * Gets Json String of Object ShippingAddress
     * @return string
     */
    public static function getJson()
    {
        return '{"recipient_name":"TestSample"}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return ShippingAddress
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new ShippingAddress(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return ShippingAddress
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new ShippingAddress(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getRecipientName());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param ShippingAddress $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals("TestSample", $obj->getRecipientName());
    }
}
