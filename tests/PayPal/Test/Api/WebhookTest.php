<?php

namespace PayPal\Test\Api;

use PayPal\Api\Webhook;
use PayPal\Exception\PayPalConfigurationException;
use PayPal\Exception\PayPalConnectionException;
use PHPUnit\Framework\TestCase;

/**
 * Class Webhook
 *
 * @package PayPal\Test\Api
 */
class WebhookTest extends TestCase
{
    /**
     * Gets Json String of Object Webhook
     * @return string
     */
    public static function getJson()
    {
        return '{"id":"TestSample","url":"http://www.google.com","event_types":' .WebhookEventTypeTest::getJson() . ',"links":' .LinksTest::getJson() . '}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return Webhook
     * @throws PayPalConfigurationException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public static function getObject()
    {
        return new Webhook(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return Webhook
     * @throws PayPalConfigurationException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new Webhook(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getId());
        $this->assertNotNull($obj->getUrl());
        $this->assertNotNull($obj->getEventTypes());
        $this->assertNotNull($obj->getLinks());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param Webhook $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getId(), "TestSample");
        $this->assertEquals($obj->getUrl(), "http://www.google.com");
        $this->assertEquals($obj->getEventTypes(), WebhookEventTypeTest::getObject());
        $this->assertEquals($obj->getLinks(), LinksTest::getObject());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Url is not a fully qualified URL
     */
    public function testUrlValidationForUrl()
    {
        $obj = new Webhook();
        $obj->setUrl(null);
    }

    /**
     * @dataProvider mockProvider
     * @param Webhook $obj
     * @param $mockApiContext
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function testCreate($obj, $mockApiContext)
    {
        $mockPPRestCall = $this->getMockBuilder('\PayPal\Transport\PayPalRestCall')
            ->disableOriginalConstructor()
            ->getMock();

        $mockPPRestCall
            ->method('execute')
            ->willReturn(self::getJson());

        $result = $obj->create($mockApiContext, $mockPPRestCall);
        $this->assertNotNull($result);
    }

    /**
     * @dataProvider mockProvider
     * @param Webhook $obj
     * @param $mockApiContext
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function testGet($obj, $mockApiContext)
    {
        $mockPPRestCall = $this->getMockBuilder('\PayPal\Transport\PayPalRestCall')
            ->disableOriginalConstructor()
            ->getMock();

        $mockPPRestCall
            ->method('execute')
            ->willReturn(WebhookTest::getJson());

        $result = $obj->get("webhookId", $mockApiContext, $mockPPRestCall);
        $this->assertNotNull($result);
    }

    /**
     * @dataProvider mockProvider
     * @param Webhook $obj
     * @param $mockApiContext
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function testGetAll($obj, $mockApiContext)
    {
        $mockPPRestCall = $this->getMockBuilder('\PayPal\Transport\PayPalRestCall')
            ->disableOriginalConstructor()
            ->getMock();

        $mockPPRestCall
            ->method('execute')
            ->willReturn(WebhookListTest::getJson());
        $params = array();

        $result = $obj->getAllWithParams($params, $mockApiContext, $mockPPRestCall);
        $this->assertNotNull($result);
    }

    /**
     * @dataProvider mockProvider
     * @param Webhook $obj
     * @param $mockApiContext
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function testUpdate($obj, $mockApiContext)
    {
        $mockPPRestCall = $this->getMockBuilder('\PayPal\Transport\PayPalRestCall')
            ->disableOriginalConstructor()
            ->getMock();

        $mockPPRestCall
            ->method('execute')
            ->willReturn(self::getJson());
        $patchRequest = PatchRequestTest::getObject();

        $result = $obj->update($patchRequest, $mockApiContext, $mockPPRestCall);
        $this->assertNotNull($result);
    }

    /**
     * @dataProvider mockProvider
     * @param Webhook $obj
     * @param $mockApiContext
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     */
    public function testDelete($obj, $mockApiContext)
    {
        $mockPPRestCall = $this->getMockBuilder('\PayPal\Transport\PayPalRestCall')
            ->disableOriginalConstructor()
            ->getMock();

        $mockPPRestCall
            ->method('execute')
            ->willReturn(true);

        $result = $obj->delete($mockApiContext, $mockPPRestCall);
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
