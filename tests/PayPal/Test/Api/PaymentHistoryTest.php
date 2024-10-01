<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Api\PaymentHistory;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class PaymentHistory
 *
 * @package PayPal\Test\Api
 */
class PaymentHistoryTest extends TestCase
{
    /**
     * Gets Json String of Object PaymentHistory
     * @return string
     */
    public static function getJson()
    {
        return '{"payments":[' . PaymentTest::getJson() . '],"count":123,"next_id":"TestSample"}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return PaymentHistory
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new PaymentHistory(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return PaymentHistory
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new PaymentHistory(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getPayments());
        $this->assertNotNull($obj->getCount());
        $this->assertNotNull($obj->getNextId());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param PaymentHistory $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getPayments(), PaymentTest::getObject());
        $this->assertEquals(123, $obj->getCount());
        $this->assertEquals("TestSample", $obj->getNextId());
    }
}
