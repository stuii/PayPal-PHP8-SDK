<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Api\Capture;
use PayPal\Exception\PayPalConfigurationException;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Transport\PPRestCall;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class Capture
 *
 * @package PayPal\Test\Api
 */
class CaptureTest extends TestCase
{
    /**
     * Gets Json String of Object Capture
     * @return string
     */
    public static function getJson()
    {
        return '{"id":"TestSample","amount":' .AmountTest::getJson() . ',"is_final_capture":true,"state":"TestSample","reason_code":"TestSample","parent_payment":"TestSample","invoice_number":"TestSample","transaction_fee":' .CurrencyTest::getJson() . ',"create_time":"TestSample","update_time":"TestSample","links":[' .LinksTest::getJson() . ']}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return Capture
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new Capture(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return Capture
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new Capture(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getId());
        $this->assertNotNull($obj->getAmount());
        $this->assertNotNull($obj->getIsFinalCapture());
        $this->assertNotNull($obj->getState());
        $this->assertNotNull($obj->getReasonCode());
        $this->assertNotNull($obj->getParentPayment());
        $this->assertNotNull($obj->getInvoiceNumber());
        $this->assertNotNull($obj->getTransactionFee());
        $this->assertNotNull($obj->getCreateTime());
        $this->assertNotNull($obj->getUpdateTime());
        $this->assertNotNull($obj->getLinks());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param Capture $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals("TestSample", $obj->getId());
        $this->assertEquals($obj->getAmount(), AmountTest::getObject());
        $this->assertTrue($obj->getIsFinalCapture());
        $this->assertEquals("TestSample", $obj->getState());
        $this->assertEquals("TestSample", $obj->getReasonCode());
        $this->assertEquals("TestSample", $obj->getParentPayment());
        $this->assertEquals("TestSample", $obj->getInvoiceNumber());
        $this->assertEquals($obj->getTransactionFee(), CurrencyTest::getObject());
        $this->assertEquals("TestSample", $obj->getCreateTime());
        $this->assertEquals("TestSample", $obj->getUpdateTime());
        $this->assertEquals($obj->getLinks(), [LinksTest::getObject()]);
    }

    /**
     * @param Capture $obj
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
            ->willReturn(CaptureTest::getJson());

        $result = $obj->get("captureId", $mockApiContext, $mockPPRestCall);
        $this->assertNotNull($result);
    }

    /**
     * @param Capture $obj
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
