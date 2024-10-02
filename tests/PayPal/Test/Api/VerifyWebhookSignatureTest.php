<?php

namespace PayPal\Test\Api;

use InvalidArgumentException;
use JsonException;
use PayPal\Api\VerifyWebhookSignature;
use PayPal\Exception\PayPalConfigurationException;
use PayPal\Exception\PayPalConnectionException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class VerifyWebhookSignature
 *
 * @package PayPal\Test\Api
 */
class VerifyWebhookSignatureTest extends TestCase
{
    /**
     * Gets Json String of Object VerifyWebhookSignature
     * @return string
     */
    public static function getJson()
    {
        return '{"auth_algo":"TestSample","cert_url":"http://www.google.com","transmission_id":"TestSample","transmission_sig":"TestSample","transmission_time":"TestSample","webhook_id":"TestSample","webhook_event":' .WebhookEventTest::getJson() . '}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return VerifyWebhookSignature
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new VerifyWebhookSignature(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return VerifyWebhookSignature
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new VerifyWebhookSignature(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getAuthAlgo());
        $this->assertNotNull($obj->getCertUrl());
        $this->assertNotNull($obj->getTransmissionId());
        $this->assertNotNull($obj->getTransmissionSig());
        $this->assertNotNull($obj->getTransmissionTime());
        $this->assertNotNull($obj->getWebhookId());
        $this->assertNotNull($obj->getWebhookEvent());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param VerifyWebhookSignature $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals("TestSample", $obj->getAuthAlgo());
        $this->assertEquals("http://www.google.com", $obj->getCertUrl());
        $this->assertEquals("TestSample", $obj->getTransmissionId());
        $this->assertEquals("TestSample", $obj->getTransmissionSig());
        $this->assertEquals("TestSample", $obj->getTransmissionTime());
        $this->assertEquals("TestSample", $obj->getWebhookId());
        $this->assertEquals($obj->getWebhookEvent(), WebhookEventTest::getObject());
    }

    public function testToJsonToIncludeRequestBodyAsWebhookEvent() {
        $obj = new VerifyWebhookSignature();
        $requestBody = '{"id":"123", "links": [], "something": {}}';
        $obj->setRequestBody($requestBody);

        $this->assertEquals($obj->toJSON(), '{"webhook_event": ' . $requestBody .'}');
    }

    /**
     * @param VerifyWebhookSignature $obj
     * @param $mockApiContext
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     * @throws JsonException
     * @throws ReflectionException
     */
    #[DataProvider('mockProvider')]
    public function testPost($obj, $mockApiContext)
    {
        $mockPPRestCall = $this->getMockBuilder('\PayPal\Transport\PayPalRestCall')
            ->disableOriginalConstructor()
            ->getMock();

        $mockPPRestCall
            ->method('execute')
            ->willReturn(VerifyWebhookSignatureResponseTest::getJson());

        $result = $obj->post($mockApiContext, $mockPPRestCall);
        $this->assertNotNull($result);
    }

    public static function mockProvider()
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
