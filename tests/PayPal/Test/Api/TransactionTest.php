<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Api\Transaction;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

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
        return '[]';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return Transaction
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new Transaction(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return Transaction
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new Transaction(self::getJson());
        $this->assertNotNull($obj);
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }
}
