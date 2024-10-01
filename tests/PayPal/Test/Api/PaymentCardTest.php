<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Api\PaymentCard;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class PaymentCard
 *
 * @package PayPal\Test\Api
 */
class PaymentCardTest extends TestCase
{
    /**
     * Gets Json String of Object PaymentCard
     * @return string
     */
    public static function getJson()
    {
        return '{"id":"TestSample","number":"TestSample","type":"TestSample","expire_month":"123","expire_year":"123","start_month":"TestSample","start_year":"TestSample","cvv2":"TestSample","first_name":"TestSample","last_name":"TestSample","billing_country":"TestSample","billing_address":' .AddressTest::getJson() . ',"external_customer_id":"TestSample","status":"TestSample","card_product_class":"TestSample","valid_until":"TestSample","issue_number":"TestSample","links":' .LinksTest::getJson() . '}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return PaymentCard
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new PaymentCard(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return PaymentCard
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new PaymentCard(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getId());
        $this->assertNotNull($obj->getNumber());
        $this->assertNotNull($obj->getType());
        $this->assertNotNull($obj->getExpireMonth());
        $this->assertNotNull($obj->getExpireYear());
        $this->assertNotNull($obj->getStartMonth());
        $this->assertNotNull($obj->getStartYear());
        $this->assertNotNull($obj->getCvv2());
        $this->assertNotNull($obj->getFirstName());
        $this->assertNotNull($obj->getLastName());
        $this->assertNotNull($obj->getBillingCountry());
        $this->assertNotNull($obj->getBillingAddress());
        $this->assertNotNull($obj->getExternalCustomerId());
        $this->assertNotNull($obj->getStatus());
        $this->assertNotNull($obj->getCardProductClass());
        $this->assertNotNull($obj->getValidUntil());
        $this->assertNotNull($obj->getIssueNumber());
        $this->assertNotNull($obj->getLinks());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param PaymentCard $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals("TestSample", $obj->getId());
        $this->assertEquals("TestSample", $obj->getNumber());
        $this->assertEquals("TestSample", $obj->getType());
        $this->assertEquals("TestSample", $obj->getExpireMonth());
        $this->assertEquals("TestSample", $obj->getExpireYear());
        $this->assertEquals("TestSample", $obj->getStartMonth());
        $this->assertEquals("TestSample", $obj->getStartYear());
        $this->assertEquals("TestSample", $obj->getCvv2());
        $this->assertEquals("TestSample", $obj->getFirstName());
        $this->assertEquals("TestSample", $obj->getLastName());
        $this->assertEquals("TestSample", $obj->getBillingCountry());
        $this->assertEquals($obj->getBillingAddress(), AddressTest::getObject());
        $this->assertEquals("TestSample", $obj->getExternalCustomerId());
        $this->assertEquals("TestSample", $obj->getStatus());
        $this->assertEquals("TestSample", $obj->getCardProductClass());
        $this->assertEquals("TestSample", $obj->getValidUntil());
        $this->assertEquals("TestSample", $obj->getIssueNumber());
        $this->assertEquals($obj->getLinks(), LinksTest::getObject());
    }
}
