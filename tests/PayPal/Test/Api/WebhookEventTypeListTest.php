<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Common\PayPalModel;
use PayPal\Api\WebhookEventTypeList;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class WebhookEventTypeList
 *
 * @package PayPal\Test\Api
 */
class WebhookEventTypeListTest extends TestCase
{
    /**
     * Gets Json String of Object WebhookEventTypeList
     * @return string
     */
    public static function getJson()
    {
        return '{"event_types":[' .WebhookEventTypeTest::getJson() . ']}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return WebhookEventTypeList
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new WebhookEventTypeList(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return WebhookEventTypeList
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new WebhookEventTypeList(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getEventTypes());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param WebhookEventTypeList $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getEventTypes(), [WebhookEventTypeTest::getObject()]);
    }


}
