<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Api\Sale;
use PayPal\Exception\PayPalConfigurationException;
use PayPal\Exception\PayPalConnectionException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class Sale
 *
 * @package PayPal\Test\Api
 */
class SaleTest extends TestCase
{
    /**
     * Gets Json String of Object Sale
     * @return string
     */
    public static function getJson()
    {
        return '{"id":"TestSample","purchase_unit_reference_id":"TestSample","amount":' . AmountTest::getJson() . ',"payment_mode":"TestSample","state":"TestSample","reason_code":"TestSample","protection_eligibility":"TestSample","protection_eligibility_type":"TestSample","clearing_time":"TestSample","payment_hold_status":"TestSample","payment_hold_reasons":["TestSample"],"transaction_fee":' . CurrencyTest::getJson() . ',"receivable_amount":' . CurrencyTest::getJson() . ',"exchange_rate":"TestSample","fmf_details":' . FmfDetailsTest::getJson() . ',"receipt_id":"TestSample","parent_payment":"TestSample","processor_response":' . ProcessorResponseTest::getJson() . ',"billing_agreement_id":"TestSample","create_time":"TestSample","update_time":"TestSample","links":[' . LinksTest::getJson() . ']}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return Sale
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new Sale(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return Sale
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new Sale(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getId());
        $this->assertNotNull($obj->getPurchaseUnitReferenceId());
        $this->assertNotNull($obj->getAmount());
        $this->assertNotNull($obj->getPaymentMode());
        $this->assertNotNull($obj->getState());
        $this->assertNotNull($obj->getReasonCode());
        $this->assertNotNull($obj->getProtectionEligibility());
        $this->assertNotNull($obj->getProtectionEligibilityType());
        $this->assertNotNull($obj->getClearingTime());
        $this->assertNotNull($obj->getPaymentHoldStatus());
        $this->assertNotNull($obj->getPaymentHoldReasons());
        $this->assertNotNull($obj->getTransactionFee());
        $this->assertNotNull($obj->getReceivableAmount());
        $this->assertNotNull($obj->getExchangeRate());
        $this->assertNotNull($obj->getFmfDetails());
        $this->assertNotNull($obj->getReceiptId());
        $this->assertNotNull($obj->getParentPayment());
        $this->assertNotNull($obj->getProcessorResponse());
        $this->assertNotNull($obj->getBillingAgreementId());
        $this->assertNotNull($obj->getCreateTime());
        $this->assertNotNull($obj->getUpdateTime());
        $this->assertNotNull($obj->getLinks());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param Sale $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals("TestSample", $obj->getId());
        $this->assertEquals("TestSample", $obj->getPurchaseUnitReferenceId());
        $this->assertEquals($obj->getAmount(), AmountTest::getObject());
        $this->assertEquals("TestSample", $obj->getPaymentMode());
        $this->assertEquals("TestSample", $obj->getState());
        $this->assertEquals("TestSample", $obj->getReasonCode());
        $this->assertEquals("TestSample", $obj->getProtectionEligibility());
        $this->assertEquals("TestSample", $obj->getProtectionEligibilityType());
        $this->assertEquals("TestSample", $obj->getClearingTime());
        $this->assertEquals("TestSample", $obj->getPaymentHoldStatus());
        $this->assertEquals(["TestSample"], $obj->getPaymentHoldReasons());
        $this->assertEquals($obj->getTransactionFee(), CurrencyTest::getObject());
        $this->assertEquals($obj->getReceivableAmount(), CurrencyTest::getObject());
        $this->assertEquals("TestSample", $obj->getExchangeRate());
        $this->assertEquals($obj->getFmfDetails(), FmfDetailsTest::getObject());
        $this->assertEquals("TestSample", $obj->getReceiptId());
        $this->assertEquals("TestSample", $obj->getParentPayment());
        $this->assertEquals($obj->getProcessorResponse(), ProcessorResponseTest::getObject());
        $this->assertEquals("TestSample", $obj->getBillingAgreementId());
        $this->assertEquals("TestSample", $obj->getCreateTime());
        $this->assertEquals("TestSample", $obj->getUpdateTime());
        $this->assertEquals($obj->getLinks(), [LinksTest::getObject()]);
    }

    /**
     * @param Sale $obj
     * @param $mockApiContext
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws JsonException
     * @throws ReflectionException
     */
    #[DataProvider('mockProvider')]
    public function testGet($obj, $mockApiContext)
    {
        $mockPPRestCall = $this->getMockBuilder('\PayPal\Transport\PayPalRestCall')
            ->disableOriginalConstructor()
            ->getMock();

        $mockPPRestCall
            ->method('execute')
            ->willReturn(SaleTest::getJson());

        $result = $obj->get("saleId", $mockApiContext, $mockPPRestCall);
        $this->assertNotNull($result);
    }

    /**
     * @param Sale $obj
     * @param $mockApiContext
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws JsonException
     * @throws ReflectionException
     */
    #[DataProvider('mockProvider')]
    public function testRefund($obj, $mockApiContext)
    {
        $mockPPRestCall = $this->getMockBuilder('\PayPal\Transport\PayPalRestCall')
            ->disableOriginalConstructor()
            ->getMock();

        $mockPPRestCall
            ->method('execute')
            ->willReturn(RefundTest::getJson());
        $refund = RefundTest::getObject();

        $result = $obj->refund($refund, $mockApiContext, $mockPPRestCall);
        $this->assertNotNull($result);
    }

    public static function mockProvider()
    {
        $obj = self::getObject();
        $mockApiContext = self::getMockBuilder('ApiContext')
            ->disableOriginalConstructor()
            ->getMock();
        return array(
            array($obj, $mockApiContext),
            array($obj, null)
        );
    }
}
