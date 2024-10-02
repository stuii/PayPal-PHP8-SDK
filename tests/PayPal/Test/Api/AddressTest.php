<?php
namespace PayPal\Test\Api;

use JsonException;
use PayPal\Api\Address;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class Address
 *
 * @package PayPal\Test\Api
 */
class AddressTest extends TestCase
{
    /**
     * Gets Json String of Object Address
     * @return string
     */
    public static function getJson()
    {
        return '{"line1":"TestSample","line2":"TestSample","city":"TestSample","country_code":"TestSample","postal_code":"TestSample","state":"TestSample","phone":"TestSample","normalization_status":"TestSample","status":"TestSample","type":"TestSample"}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return Address
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new Address(self::getJson());
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return Address
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new Address(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getLine1());
        $this->assertNotNull($obj->getLine2());
        $this->assertNotNull($obj->getCity());
        $this->assertNotNull($obj->getCountryCode());
        $this->assertNotNull($obj->getPostalCode());
        $this->assertNotNull($obj->getState());
        $this->assertNotNull($obj->getPhone());
        $this->assertNotNull($obj->getNormalizationStatus());
        $this->assertNotNull($obj->getStatus());
        $this->assertNotNull($obj->getType());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param Address $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals("TestSample", $obj->getLine1());
        $this->assertEquals("TestSample", $obj->getLine2());
        $this->assertEquals("TestSample", $obj->getCity());
        $this->assertEquals("TestSample", $obj->getCountryCode());
        $this->assertEquals("TestSample", $obj->getPostalCode());
        $this->assertEquals("TestSample", $obj->getState());
        $this->assertEquals("TestSample", $obj->getPhone());
        $this->assertEquals("TestSample", $obj->getNormalizationStatus());
        $this->assertEquals("TestSample", $obj->getStatus());
        $this->assertEquals("TestSample", $obj->getType());
    }
}
