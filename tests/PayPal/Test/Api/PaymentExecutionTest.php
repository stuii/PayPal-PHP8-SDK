<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Api\PaymentExecution;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class PaymentExecution
 *
 * @package PayPal\Test\Api
 */
class PaymentExecutionTest extends TestCase
{
    /**
     * Gets Json String of Object PaymentExecution
     * @return string
     */
    public static function getJson()
    {
        return '{"payer_id":"TestSample","transactions":[' . TransactionTest::getJson() . ']}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return PaymentExecution
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new PaymentExecution(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return PaymentExecution
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new PaymentExecution(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getPayerId());
        $this->assertNotNull($obj->getTransactions());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param PaymentExecution $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals("TestSample", $obj->getPayerId());
        $this->assertEquals($obj->getTransactions(), [TransactionTest::getObject()]);
    }
}
