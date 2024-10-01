<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Api\Billing;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class Billing
 *
 * @package PayPal\Test\Api
 */
class BillingTest extends TestCase
{
    /**
     * Gets Json String of Object Billing
     * @return string
     */
    public static function getJson()
    {
        return '{"billing_agreement_id":"TestSample"}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return Billing
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new Billing(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return Billing
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new Billing(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getBillingAgreementId());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param Billing $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals("TestSample", $obj->getBillingAgreementId());
    }
}
