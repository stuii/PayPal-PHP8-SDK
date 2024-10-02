<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Api\CreditCard;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class CreditCard
 *
 * @package PayPal\Test\Api
 */
class CreditCardTest extends TestCase
{
    /**
     * Gets Json String of Object CreditCard
     *
     * @return string
     */
    public static function getJson()
    {
        return '{"id":"TestSample","number":"TestSample","type":"TestSample","expire_month":123,"expire_year":123,"cvv2":"TestSample","first_name":"TestSample","last_name":"TestSample","billing_address":' . AddressTest::getJson() . ',"external_customer_id":"TestSample","state":"TestSample","valid_until":"TestSample","links":[' . LinksTest::getJson() . ']}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return CreditCard
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new CreditCard(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     *
     * @return CreditCard
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new CreditCard(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getId());
        $this->assertNotNull($obj->getNumber());
        $this->assertNotNull($obj->getType());
        $this->assertNotNull($obj->getExpireMonth());
        $this->assertNotNull($obj->getExpireYear());
        $this->assertNotNull($obj->getCvv2());
        $this->assertNotNull($obj->getFirstName());
        $this->assertNotNull($obj->getLastName());
        $this->assertNotNull($obj->getBillingAddress());
        $this->assertNotNull($obj->getExternalCustomerId());
        $this->assertNotNull($obj->getState());
        $this->assertNotNull($obj->getValidUntil());
        $this->assertNotNull($obj->getLinks());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param CreditCard $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals("TestSample", $obj->getId());
        $this->assertEquals("TestSample", $obj->getNumber());
        $this->assertEquals("TestSample", $obj->getType());
        $this->assertEquals(123, $obj->getExpireMonth());
        $this->assertEquals(123, $obj->getExpireYear());
        $this->assertEquals("TestSample", $obj->getCvv2());
        $this->assertEquals("TestSample", $obj->getFirstName());
        $this->assertEquals("TestSample", $obj->getLastName());
        $this->assertEquals($obj->getBillingAddress(), AddressTest::getObject());
        $this->assertEquals("TestSample", $obj->getExternalCustomerId());
        $this->assertEquals("TestSample", $obj->getState());
        $this->assertEquals("TestSample", $obj->getValidUntil());
        $this->assertEquals($obj->getLinks(), [LinksTest::getObject()]);
    }
}
