<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Api\Payer;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class Payer
 *
 * @package PayPal\Test\Api
 */
class PayerTest extends TestCase
{
    /**
     * Gets Json String of Object Payer
     * @return string
     */
    public static function getJson()
    {
        return '{"payment_method":"TestSample","status":"TestSample","funding_instruments":[' .FundingInstrumentTest::getJson() . '],"external_selected_funding_instrument_type":"TestSample","payer_info":' .PayerInfoTest::getJson() . '}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return Payer
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new Payer(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return Payer
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new Payer(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getPaymentMethod());
        $this->assertNotNull($obj->getStatus());
        $this->assertNotNull($obj->getFundingInstruments());
        $this->assertNotNull($obj->getExternalSelectedFundingInstrumentType());
        $this->assertNotNull($obj->getPayerInfo());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param Payer $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals("TestSample", $obj->getPaymentMethod());
        $this->assertEquals("TestSample", $obj->getStatus());
        $this->assertEquals($obj->getFundingInstruments(), FundingInstrumentTest::getObject());
        $this->assertEquals("TestSample", $obj->getExternalSelectedFundingInstrumentType());
        $this->assertEquals($obj->getPayerInfo(), PayerInfoTest::getObject());
    }
}
