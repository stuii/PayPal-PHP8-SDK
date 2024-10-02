<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Common\PayPalModel;
use PayPal\Api\WebhookList;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class WebhookList
 *
 * @package PayPal\Test\Api
 */
class WebhookListTest extends TestCase
{
    /**
     * Gets Json String of Object WebhookList
     * @return string
     */
    public static function getJson()
    {
        return '{"webhooks":[' .WebhookTest::getJson() . ']}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return WebhookList
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new WebhookList(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return WebhookList
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new WebhookList(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getWebhooks());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param WebhookList $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getWebhooks(), [WebhookTest::getObject()]);
    }


}
