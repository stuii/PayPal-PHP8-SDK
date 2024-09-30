<?php

namespace PayPal\Test\Api;

use PayPal\Api\ShippingAddress;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\TestCase;

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
        return '{"id":"TestSample","recipient_name":"TestSample","default_address":true}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return ShippingAddress
     * @throws PayPalConfigurationException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public static function getObject()
    {
        return new ShippingAddress(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return ShippingAddress
     * @throws PayPalConfigurationException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new ShippingAddress(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getId());
        $this->assertNotNull($obj->getRecipientName());
        $this->assertNotNull($obj->getDefaultAddress());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param ShippingAddress $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getId(), "TestSample");
        $this->assertEquals($obj->getRecipientName(), "TestSample");
        $this->assertEquals($obj->getDefaultAddress(), true);
    }
}
