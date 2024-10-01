<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Api\Authorization;
use PayPal\Api\Order;
use PayPal\Exception\PayPalConfigurationException;
use PayPal\Exception\PayPalConnectionException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class Order
 *
 * @package PayPal\Test\Api
 */
class OrderTest extends TestCase
{
    /**
     * Gets Json String of Object Order
     * @return string
     */
    public static function getJson()
    {
        return '{"id":"TestSample","reference_id":"TestSample","amount":' .AmountTest::getJson() . ',"payment_mode":"TestSample","state":"TestSample","reason_code":"TestSample","pending_reason":"TestSample","protection_eligibility":"TestSample","protection_eligibility_type":"TestSample","parent_payment":"TestSample","fmf_details":' .FmfDetailsTest::getJson() . ',"create_time":"TestSample","update_time":"TestSample","links":[' .LinksTest::getJson() . ']}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return Order
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new Order(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return Order
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new Order(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getId());
        $this->assertNotNull($obj->getReferenceId());
        $this->assertNotNull($obj->getAmount());
        $this->assertNotNull($obj->getPaymentMode());
        $this->assertNotNull($obj->getState());
        $this->assertNotNull($obj->getReasonCode());
        $this->assertNotNull($obj->getPendingReason());
        $this->assertNotNull($obj->getProtectionEligibility());
        $this->assertNotNull($obj->getProtectionEligibilityType());
        $this->assertNotNull($obj->getParentPayment());
        $this->assertNotNull($obj->getFmfDetails());
        $this->assertNotNull($obj->getCreateTime());
        $this->assertNotNull($obj->getUpdateTime());
        $this->assertNotNull($obj->getLinks());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param Order $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals("TestSample", $obj->getId());
        $this->assertEquals("TestSample", $obj->getReferenceId());
        $this->assertEquals($obj->getAmount(), AmountTest::getObject());
        $this->assertEquals("TestSample", $obj->getPaymentMode());
        $this->assertEquals("TestSample", $obj->getState());
        $this->assertEquals("TestSample", $obj->getReasonCode());
        $this->assertEquals("TestSample", $obj->getPendingReason());
        $this->assertEquals("TestSample", $obj->getProtectionEligibility());
        $this->assertEquals("TestSample", $obj->getProtectionEligibilityType());
        $this->assertEquals("TestSample", $obj->getParentPayment());
        $this->assertEquals($obj->getFmfDetails(), FmfDetailsTest::getObject());
        $this->assertEquals("TestSample", $obj->getCreateTime());
        $this->assertEquals("TestSample", $obj->getUpdateTime());
        $this->assertEquals($obj->getLinks(), [LinksTest::getObject()]);
    }

    /**
     * @param Order $obj
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
            ->willReturn(OrderTest::getJson());

        $result = $obj->get("orderId", $mockApiContext, $mockPPRestCall);
        $this->assertNotNull($result);
    }

    /**
     * @param Order $obj
     * @param $mockApiContext
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws JsonException
     * @throws ReflectionException
     */
    #[DataProvider('mockProvider')]
    public function testCapture($obj, $mockApiContext)
    {
        $mockPPRestCall = $this->getMockBuilder('\PayPal\Transport\PayPalRestCall')
            ->disableOriginalConstructor()
            ->getMock();

        $mockPPRestCall
            ->method('execute')
            ->willReturn(CaptureTest::getJson());
        $capture = CaptureTest::getObject();

        $result = $obj->capture($capture, $mockApiContext, $mockPPRestCall);
        $this->assertNotNull($result);
    }

    /**
     * @param Order $obj
     * @param $mockApiContext
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws JsonException
     * @throws ReflectionException
     */
    #[DataProvider('mockProvider')]
    public function testVoid($obj, $mockApiContext)
    {
        $mockPPRestCall = $this->getMockBuilder('\PayPal\Transport\PayPalRestCall')
            ->disableOriginalConstructor()
            ->getMock();

        $mockPPRestCall
            ->method('execute')
            ->willReturn(self::getJson());

        $result = $obj->void($mockApiContext, $mockPPRestCall);
        $this->assertNotNull($result);
    }

    /**
     * @param Order $obj
     * @param $mockApiContext
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws JsonException
     * @throws ReflectionException
     */
    #[DataProvider('mockProvider')]
    public function testAuthorize($obj, $mockApiContext)
    {
        $mockPPRestCall = $this->getMockBuilder('\PayPal\Transport\PayPalRestCall')
            ->disableOriginalConstructor()
            ->getMock();

        $mockPPRestCall
            ->method('execute')
            ->willReturn(AuthorizationTest::getJson());

        $authorization = new Authorization();
        $result = $obj->authorize($authorization, $mockApiContext, $mockPPRestCall);
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
