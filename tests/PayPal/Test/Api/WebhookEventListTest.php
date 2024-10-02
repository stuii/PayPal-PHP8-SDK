<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Common\PayPalModel;
use PayPal\Api\WebhookEventList;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class WebhookEventList
 *
 * @package PayPal\Test\Api
 */
class WebhookEventListTest extends TestCase
{
    /**
     * Gets Json String of Object WebhookEventList
     * @return string
     */
    public static function getJson()
    {
        return '{"events":[' .WebhookEventTest::getJson() . '],"count":123,"links":[' .LinksTest::getJson() . ']}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return WebhookEventList
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new WebhookEventList(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return WebhookEventList
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new WebhookEventList(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getEvents());
        $this->assertNotNull($obj->getCount());
        $this->assertNotNull($obj->getLinks());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param WebhookEventList $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getEvents(), [WebhookEventTest::getObject()]);
        $this->assertEquals(123, $obj->getCount());
        $this->assertEquals($obj->getLinks(), [LinksTest::getObject()]);
    }


}
