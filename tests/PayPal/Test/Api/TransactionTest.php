<?php

namespace PayPal\Test\Api;

use PayPal\Api\Transaction;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\TestCase;

/**
 * Class Transaction
 *
 * @package PayPal\Test\Api
 */
class TransactionTest extends TestCase
{
    /**
     * Gets Json String of Object Transaction
     *
     * @return string
     */
    public static function getJson()
    {
        return '{}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return Transaction
     * @throws PayPalConfigurationException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public static function getObject()
    {
        return new Transaction(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return Transaction
     * @throws PayPalConfigurationException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new Transaction(self::getJson());
        $this->assertNotNull($obj);
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param Transaction $obj
     */
    public function testGetters($obj)
    {
    }
}
