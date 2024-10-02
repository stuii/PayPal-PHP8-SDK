<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Api\CreditCardToken;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class CreditCardToken
 *
 * @package PayPal\Test\Api
 */
class CreditCardTokenTest extends TestCase
{
    /**
     * Gets Json String of Object CreditCardToken
     *
     * @return string
     */
    public static function getJson()
    {
        return '{"credit_card_id":"TestSample","payer_id":"TestSample","last4":"TestSample","type":"TestSample","expire_month":123,"expire_year":123}';
    }

    /**
     * Gets Object Instance with Json data filled in
     *
     * @return CreditCardToken
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new CreditCardToken(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     *
     * @return CreditCardToken
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new CreditCardToken(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getCreditCardId());
        $this->assertNotNull($obj->getPayerId());
        $this->assertNotNull($obj->getLast4());
        $this->assertNotNull($obj->getType());
        $this->assertNotNull($obj->getExpireMonth());
        $this->assertNotNull($obj->getExpireYear());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param CreditCardToken $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals("TestSample", $obj->getCreditCardId());
        $this->assertEquals("TestSample", $obj->getPayerId());
        $this->assertEquals("TestSample", $obj->getLast4());
        $this->assertEquals("TestSample", $obj->getType());
        $this->assertEquals(123, $obj->getExpireMonth());
        $this->assertEquals(123, $obj->getExpireYear());
    }
}
