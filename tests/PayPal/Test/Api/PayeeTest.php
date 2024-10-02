<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Api\Payee;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class Payee
 *
 * @package PayPal\Test\Api
 */
class PayeeTest extends TestCase
{
    /**
     * Gets Json String of Object Payee
     * @return string
     */
    public static function getJson()
    {
        return '{"email":"TestSample","merchant_id":"TestSample"}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return Payee
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new Payee(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return Payee
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new Payee(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getEmail());
        $this->assertNotNull($obj->getMerchantId());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param Payee $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals("TestSample", $obj->getEmail());
        $this->assertEquals("TestSample", $obj->getMerchantId());
    }
}
