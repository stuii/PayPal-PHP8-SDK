<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Api\DetailedRefund;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class DetailedRefund
 *
 * @package PayPal\Test\Api
 */
class DetailedRefundTest extends TestCase
{
    /**
     * Gets Json String of Object DetailedRefund
     * @return string
     */
    public static function getJson()
    {
        return '{"custom":"TestSample","invoice_number":"TestSample","refund_to_payer":' .CurrencyTest::getJson() . ',"refund_to_external_funding":[' .ExternalFundingTest::getJson() . '],"refund_from_transaction_fee":' .CurrencyTest::getJson() . ',"refund_from_received_amount":' .CurrencyTest::getJson() . ',"total_refunded_amount":' .CurrencyTest::getJson() . '}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return DetailedRefund
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new DetailedRefund(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return DetailedRefund
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new DetailedRefund(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getCustom());
        $this->assertNotNull($obj->getInvoiceNumber());
        $this->assertNotNull($obj->getRefundToPayer());
        $this->assertNotNull($obj->getRefundToExternalFunding());
        $this->assertNotNull($obj->getRefundFromTransactionFee());
        $this->assertNotNull($obj->getRefundFromReceivedAmount());
        $this->assertNotNull($obj->getTotalRefundedAmount());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param DetailedRefund $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals("TestSample", $obj->getCustom());
        $this->assertEquals("TestSample", $obj->getInvoiceNumber());
        $this->assertEquals($obj->getRefundToPayer(), CurrencyTest::getObject());
        $this->assertEquals($obj->getRefundToExternalFunding(), [ExternalFundingTest::getObject()]);
        $this->assertEquals($obj->getRefundFromTransactionFee(), CurrencyTest::getObject());
        $this->assertEquals($obj->getRefundFromReceivedAmount(), CurrencyTest::getObject());
        $this->assertEquals($obj->getTotalRefundedAmount(), CurrencyTest::getObject());
    }


}
