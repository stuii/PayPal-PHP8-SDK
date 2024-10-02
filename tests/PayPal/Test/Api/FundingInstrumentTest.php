<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Api\FundingInstrument;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class FundingInstrument
 *
 * @package PayPal\Test\Api
 */
class FundingInstrumentTest extends TestCase
{
    /**
     * Gets Json String of Object FundingInstrument
     * @return string
     */
    public static function getJson()
    {
        return '{"credit_card":' . CreditCardTest::getJson() . ',"credit_card_token":' . CreditCardTokenTest::getJson() . ',"payment_card":' . PaymentCardTest::getJson() . ',"billing":' . BillingTest::getJson() . '}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return FundingInstrument
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new FundingInstrument(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return FundingInstrument
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new FundingInstrument(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getCreditCard());
        $this->assertNotNull($obj->getCreditCardToken());
        $this->assertNotNull($obj->getPaymentCard());
        $this->assertNotNull($obj->getBilling());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param FundingInstrument $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getCreditCard(), CreditCardTest::getObject());
        $this->assertEquals($obj->getCreditCardToken(), CreditCardTokenTest::getObject());
        $this->assertEquals($obj->getPaymentCard(), PaymentCardTest::getObject());
        $this->assertEquals($obj->getBilling(), BillingTest::getObject());
    }
}
