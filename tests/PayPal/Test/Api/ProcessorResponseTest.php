<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Api\ProcessorResponse;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class ProcessorResponse
 *
 * @package PayPal\Test\Api
 */
class ProcessorResponseTest extends TestCase
{
    /**
     * Gets Json String of Object ProcessorResponse
     * @return string
     */
    public static function getJson()
    {
        return '{"response_code":"TestSample","avs_code":"TestSample","cvv_code":"TestSample","advice_code":"TestSample","eci_submitted":"TestSample","vpas":"TestSample"}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return ProcessorResponse
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new ProcessorResponse(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return ProcessorResponse
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new ProcessorResponse(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getResponseCode());
        $this->assertNotNull($obj->getAvsCode());
        $this->assertNotNull($obj->getCvvCode());
        $this->assertNotNull($obj->getAdviceCode());
        $this->assertNotNull($obj->getEciSubmitted());
        $this->assertNotNull($obj->getVpas());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param ProcessorResponse $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals("TestSample", $obj->getResponseCode());
        $this->assertEquals("TestSample", $obj->getAvsCode());
        $this->assertEquals("TestSample", $obj->getCvvCode());
        $this->assertEquals("TestSample", $obj->getAdviceCode());
        $this->assertEquals("TestSample", $obj->getEciSubmitted());
        $this->assertEquals("TestSample", $obj->getVpas());
    }
}
