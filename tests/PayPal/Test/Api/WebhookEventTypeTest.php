<?php

namespace PayPal\Test\Api;

use PayPal\Api\WebhookEventType;
use PayPal\Exception\PayPalConfigurationException;
use PayPal\Exception\PayPalConnectionException;
use PHPUnit\Framework\TestCase;

/**
 * Class WebhookEventType
 *
 * @package PayPal\Test\Api
 */
class WebhookEventTypeTest extends TestCase
{
    /**
     * Gets Json String of Object WebhookEventType
     * @return string
     */
    public static function getJson()
    {
        return '{"name":"TestSample","description":"TestSample","status":"TestSample"}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return WebhookEventType
     * @throws PayPalConfigurationException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public static function getObject()
    {
        return new WebhookEventType(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return WebhookEventType
     * @throws PayPalConfigurationException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new WebhookEventType(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getName());
        $this->assertNotNull($obj->getDescription());
        $this->assertNotNull($obj->getStatus());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param WebhookEventType $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getName(), "TestSample");
        $this->assertEquals($obj->getDescription(), "TestSample");
        $this->assertEquals($obj->getStatus(), "TestSample");
    }

    /**
     * @dataProvider mockProvider
     * @param WebhookEventType $obj
     * @param $mockApiContext
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function testSubscribedEventTypes($obj, $mockApiContext)
    {
        $mockPPRestCall = $this->getMockBuilder('\PayPal\Transport\PayPalRestCall')
            ->disableOriginalConstructor()
            ->getMock();

        $mockPPRestCall
            ->method('execute')
            ->willReturn(WebhookEventTypeListTest::getJson());

        $result = $obj->subscribedEventTypes("webhookId", $mockApiContext, $mockPPRestCall);
        $this->assertNotNull($result);
    }

    /**
     * @dataProvider mockProvider
     * @param WebhookEventType $obj
     * @param $mockApiContext
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function testAvailableEventTypes($obj, $mockApiContext)
    {
        $mockPPRestCall = $this->getMockBuilder('\PayPal\Transport\PayPalRestCall')
            ->disableOriginalConstructor()
            ->getMock();

        $mockPPRestCall
            ->method('execute')
            ->willReturn(WebhookEventTypeListTest::getJson());

        $result = $obj->availableEventTypes($mockApiContext, $mockPPRestCall);
        $this->assertNotNull($result);
    }

    public function mockProvider()
    {
        $obj = self::getObject();
        $mockApiContext = $this->getMockBuilder('ApiContext')
                    ->disableOriginalConstructor()
                    ->getMock();
        return array(
            array($obj, $mockApiContext),
            array($obj, null)
        );
    }
}
