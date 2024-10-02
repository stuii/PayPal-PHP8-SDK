<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Api\PaymentOptions;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class PaymentOptions
 *
 * @package PayPal\Test\Api
 */
class PaymentOptionsTest extends TestCase
{
    /**
     * Gets Json String of Object PaymentOptions
     * @return string
     */
    public static function getJson()
    {
        return '{"allowed_payment_method":"TestSample"}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return PaymentOptions
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new PaymentOptions(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return PaymentOptions
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new PaymentOptions(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getAllowedPaymentMethod());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param PaymentOptions $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals("TestSample", $obj->getAllowedPaymentMethod());
    }
}
