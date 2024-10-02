<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Api\RefundRequest;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class RefundRequest
 *
 * @package PayPal\Test\Api
 */
class RefundRequestTest extends TestCase
{
    /**
     * Gets Json String of Object RefundRequest
     * @return string
     */
    public static function getJson()
    {
        return '{"amount":' .AmountTest::getJson() . ',"description":"TestSample","refund_source":"TestSample","reason":"TestSample","invoice_number":"TestSample","refund_advice":true}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return RefundRequest
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new RefundRequest(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return RefundRequest
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new RefundRequest(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getAmount());
        $this->assertNotNull($obj->getDescription());
        $this->assertNotNull($obj->getRefundSource());
        $this->assertNotNull($obj->getReason());
        $this->assertNotNull($obj->getInvoiceNumber());
        $this->assertNotNull($obj->getRefundAdvice());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param RefundRequest $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getAmount(), AmountTest::getObject());
        $this->assertEquals("TestSample", $obj->getDescription());
        $this->assertEquals("TestSample", $obj->getRefundSource());
        $this->assertEquals("TestSample", $obj->getReason());
        $this->assertEquals("TestSample", $obj->getInvoiceNumber());
        $this->assertTrue($obj->getRefundAdvice());
    }


}
