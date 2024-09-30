<?php

namespace PayPal\Test\Api;

use PayPal\Api\PaymentExecution;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\TestCase;

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
        return '{"payer_id":"TestSample","carrier_account_id":"TestSample","transactions":[' . TransactionTest::getJson() . ']}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return PaymentExecution
     * @throws PayPalConfigurationException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public static function getObject()
    {
        return new PaymentExecution(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return PaymentExecution
     * @throws PayPalConfigurationException
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $this->markTestSkipped('must be revisited.');
        $obj = new PaymentExecution(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getPayerId());
        $this->assertNotNull($obj->getTransactions());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param PaymentExecution $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getPayerId(), "TestSample");
        $this->assertEquals($obj->getTransactions(), array(TransactionTest::getObject()));
    }
}
