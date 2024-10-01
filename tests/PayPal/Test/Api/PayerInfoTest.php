<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Api\PayerInfo;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class PayerInfo
 *
 * @package PayPal\Test\Api
 */
class PayerInfoTest extends TestCase
{
    /**
     * Gets Json String of Object PayerInfo
     * @return string
     */
    public static function getJson()
    {
        return '{"email":"TestSample","external_remember_me_id":"TestSample","buyer_account_number":"TestSample","salutation":"TestSample","first_name":"TestSample","middle_name":"TestSample","last_name":"TestSample","suffix":"TestSample","payer_id":"TestSample","phone":"TestSample","phone_type":"TestSample","birth_date":"TestSample","tax_id":"TestSample","tax_id_type":"TestSample","country_code":"TestSample","billing_address":' .AddressTest::getJson() . '}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return PayerInfo
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new PayerInfo(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return PayerInfo
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new PayerInfo(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getEmail());
        $this->assertNotNull($obj->getExternalRememberMeId());
        $this->assertNotNull($obj->getBuyerAccountNumber());
        $this->assertNotNull($obj->getSalutation());
        $this->assertNotNull($obj->getFirstName());
        $this->assertNotNull($obj->getMiddleName());
        $this->assertNotNull($obj->getLastName());
        $this->assertNotNull($obj->getSuffix());
        $this->assertNotNull($obj->getPayerId());
        $this->assertNotNull($obj->getPhone());
        $this->assertNotNull($obj->getPhoneType());
        $this->assertNotNull($obj->getBirthDate());
        $this->assertNotNull($obj->getTaxId());
        $this->assertNotNull($obj->getTaxIdType());
        $this->assertNotNull($obj->getCountryCode());
        $this->assertNotNull($obj->getBillingAddress());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param PayerInfo $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals("TestSample", $obj->getEmail());
        $this->assertEquals("TestSample", $obj->getExternalRememberMeId());
        $this->assertEquals("TestSample", $obj->getBuyerAccountNumber());
        $this->assertEquals("TestSample", $obj->getSalutation());
        $this->assertEquals("TestSample", $obj->getFirstName());
        $this->assertEquals("TestSample", $obj->getMiddleName());
        $this->assertEquals("TestSample", $obj->getLastName());
        $this->assertEquals("TestSample", $obj->getSuffix());
        $this->assertEquals("TestSample", $obj->getPayerId());
        $this->assertEquals("TestSample", $obj->getPhone());
        $this->assertEquals("TestSample", $obj->getPhoneType());
        $this->assertEquals("TestSample", $obj->getBirthDate());
        $this->assertEquals("TestSample", $obj->getTaxId());
        $this->assertEquals("TestSample", $obj->getTaxIdType());
        $this->assertEquals("TestSample", $obj->getCountryCode());
        $this->assertEquals($obj->getBillingAddress(), AddressTest::getObject());
    }
}
