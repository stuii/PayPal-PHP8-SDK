<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Api\Refund;
use PayPal\Exception\PayPalConfigurationException;
use PayPal\Exception\PayPalConnectionException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class Refund
 *
 * @package PayPal\Test\Api
 */
class RefundTest extends TestCase
{
    /**
     * Gets Json String of Object Refund
     * @return string
     */
    public static function getJson()
    {
        return '{"id":"TestSample","amount":' .AmountTest::getJson() . ',"state":"TestSample","reason":"TestSample","invoice_number":"TestSample","sale_id":"TestSample","capture_id":"TestSample","parent_payment":"TestSample","description":"TestSample","create_time":"TestSample","update_time":"TestSample","reason_code":"TestSample","links":[' .LinksTest::getJson() . ']}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return Refund
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new Refund(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return Refund
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new Refund(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getId());
        $this->assertNotNull($obj->getAmount());
        $this->assertNotNull($obj->getState());
        $this->assertNotNull($obj->getReason());
        $this->assertNotNull($obj->getInvoiceNumber());
        $this->assertNotNull($obj->getSaleId());
        $this->assertNotNull($obj->getCaptureId());
        $this->assertNotNull($obj->getParentPayment());
        $this->assertNotNull($obj->getDescription());
        $this->assertNotNull($obj->getCreateTime());
        $this->assertNotNull($obj->getUpdateTime());
        $this->assertNotNull($obj->getReasonCode());
        $this->assertNotNull($obj->getLinks());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param Refund $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals("TestSample", $obj->getId());
        $this->assertEquals($obj->getAmount(), AmountTest::getObject());
        $this->assertEquals("TestSample", $obj->getState());
        $this->assertEquals("TestSample", $obj->getReason());
        $this->assertEquals("TestSample", $obj->getInvoiceNumber());
        $this->assertEquals("TestSample", $obj->getSaleId());
        $this->assertEquals("TestSample", $obj->getCaptureId());
        $this->assertEquals("TestSample", $obj->getParentPayment());
        $this->assertEquals("TestSample", $obj->getDescription());
        $this->assertEquals("TestSample", $obj->getCreateTime());
        $this->assertEquals("TestSample", $obj->getUpdateTime());
        $this->assertEquals("TestSample", $obj->getReasonCode());
        $this->assertEquals($obj->getLinks(), [LinksTest::getObject()]);
    }

    /**
     * @param Refund $obj
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
            ->willReturn(RefundTest::getJson());

        $result = $obj->get("refundId", $mockApiContext, $mockPPRestCall);
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
