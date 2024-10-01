<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Api\VerifyWebhookSignatureResponse;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class VerifyWebhookSignatureResponse
 *
 * @package PayPal\Test\Api
 */
class VerifyWebhookSignatureResponseTest extends TestCase
{
    /**
     * Gets Json String of Object VerifyWebhookSignatureResponse
     * @return string
     */
    public static function getJson()
    {
        return '{"verification_status":"TestSample"}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return VerifyWebhookSignatureResponse
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new VerifyWebhookSignatureResponse(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return VerifyWebhookSignatureResponse
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new VerifyWebhookSignatureResponse(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getVerificationStatus());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param VerifyWebhookSignatureResponse $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals("TestSample", $obj->getVerificationStatus());
    }

}
