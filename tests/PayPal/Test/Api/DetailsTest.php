<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Api\Details;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class Details
 *
 * @package PayPal\Test\Api
 */
class DetailsTest extends TestCase
{
    /**
     * Gets Json String of Object Details
     *
     * @return string
     */
    public static function getJson()
    {
        return '{"subtotal":"12.34","shipping":"12.34","tax":"12.34","handling_fee":"12.34","shipping_discount":"12.34","insurance":"12.34","gift_wrap":"12.34","fee":"12.34"}';
    }

    /**
     * Gets Object Instance with Json data filled in
     *
     * @return Details
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new Details(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     *
     * @return Details
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new Details(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getSubtotal());
        $this->assertNotNull($obj->getShipping());
        $this->assertNotNull($obj->getTax());
        $this->assertNotNull($obj->getHandlingFee());
        $this->assertNotNull($obj->getShippingDiscount());
        $this->assertNotNull($obj->getInsurance());
        $this->assertNotNull($obj->getGiftWrap());
        $this->assertNotNull($obj->getFee());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param Details $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals("12.34", $obj->getSubtotal());
        $this->assertEquals("12.34", $obj->getShipping());
        $this->assertEquals("12.34", $obj->getTax());
        $this->assertEquals("12.34", $obj->getHandlingFee());
        $this->assertEquals("12.34", $obj->getShippingDiscount());
        $this->assertEquals("12.34", $obj->getInsurance());
        $this->assertEquals("12.34", $obj->getGiftWrap());
        $this->assertEquals("12.34", $obj->getFee());
    }
}
