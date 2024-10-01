<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Api\WebhookEvent;
use PayPal\Exception\PayPalConfigurationException;
use PayPal\Exception\PayPalConnectionException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class WebhookEvent
 *
 * @package PayPal\Test\Api
 */
class WebhookEventTest extends TestCase
{
    /**
     * Gets Json String of Object WebhookEvent
     * @return string
     */
    public static function getJson()
    {
        return '{"id":"TestSample","create_time":"TestSample","resource_type":"TestSample","event_version":"TestSample","event_type":"TestSample","summary":"TestSample","links":[' .LinksTest::getJson() . ']}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return WebhookEvent
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new WebhookEvent(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return WebhookEvent
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new WebhookEvent(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getId());
        $this->assertNotNull($obj->getCreateTime());
        $this->assertNotNull($obj->getResourceType());
        $this->assertNotNull($obj->getEventVersion());
        $this->assertNotNull($obj->getEventType());
        $this->assertNotNull($obj->getSummary());
        $this->assertNotNull($obj->getLinks());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param WebhookEvent $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals("TestSample", $obj->getId());
        $this->assertEquals("TestSample", $obj->getCreateTime());
        $this->assertEquals("TestSample", $obj->getResourceType());
        $this->assertEquals("TestSample", $obj->getEventVersion());
        $this->assertEquals("TestSample", $obj->getEventType());
        $this->assertEquals("TestSample", $obj->getSummary());
        $this->assertEquals($obj->getLinks(), [LinksTest::getObject()]);
    }

    /**
     * @param WebhookEvent $obj
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
            ->willReturn(WebhookEventTest::getJson());

        $result = $obj->get("eventId", $mockApiContext, $mockPPRestCall);
        $this->assertNotNull($result);
    }

    /**
     * @param WebhookEvent $obj
     * @param $mockApiContext
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws JsonException
     * @throws ReflectionException
     */
    #[DataProvider('mockProvider')]
    public function testResend($obj, $mockApiContext)
    {
        $mockPPRestCall = $this->getMockBuilder('\PayPal\Transport\PayPalRestCall')
            ->disableOriginalConstructor()
            ->getMock();

        $mockPPRestCall
            ->method('execute')
            ->willReturn(self::getJson());
        $eventResend = EventResendTest::getObject();

        $result = $obj->resend($eventResend, $mockApiContext, $mockPPRestCall);
        $this->assertNotNull($result);
    }

    /**
     * @param WebhookEvent $obj
     * @param $mockApiContext
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws JsonException
     * @throws ReflectionException
     */
    #[DataProvider('mockProvider')]
    public function testList($obj, $mockApiContext)
    {
        $mockPPRestCall = $this->getMockBuilder('\PayPal\Transport\PayPalRestCall')
            ->disableOriginalConstructor()
            ->getMock();

        $mockPPRestCall
            ->method('execute')
            ->willReturn(WebhookEventListTest::getJson());
        $params = array();

        $result = $obj->all($params, $mockApiContext, $mockPPRestCall);
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
