<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Api\ExternalFunding;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class ExternalFunding
 *
 * @package PayPal\Test\Api
 */
class ExternalFundingTest extends TestCase
{
    /**
     * Gets Json String of Object ExternalFunding
     * @return string
     */
    public static function getJson()
    {
        return '{"reference_id":"TestSample","code":"TestSample","funding_account_id":"TestSample","display_text":"TestSample","amount":' .AmountTest::getJson() . '}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return ExternalFunding
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new ExternalFunding(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return ExternalFunding
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new ExternalFunding(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getReferenceId());
        $this->assertNotNull($obj->getCode());
        $this->assertNotNull($obj->getFundingAccountId());
        $this->assertNotNull($obj->getDisplayText());
        $this->assertNotNull($obj->getAmount());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param ExternalFunding $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals("TestSample", $obj->getReferenceId());
        $this->assertEquals("TestSample", $obj->getCode());
        $this->assertEquals("TestSample", $obj->getFundingAccountId());
        $this->assertEquals("TestSample", $obj->getDisplayText());
        $this->assertEquals($obj->getAmount(), AmountTest::getObject());
    }
}
