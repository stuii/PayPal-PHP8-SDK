<?php

namespace PayPal\Test\Api;

use InvalidArgumentException;
use JsonException;
use PayPal\Api\Item;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class Item
 *
 * @package PayPal\Test\Api
 */
class ItemTest extends TestCase
{
    /**
     * Gets Json String of Object Item
     * @return string
     */
    public static function getJson()
    {
        return '{"sku":"TestSample","name":"TestSample","description":"TestSample","quantity":"12.34","price":"12.34","currency":"TestSample","tax":"12.34","url":"http:\/\/www.google.com"}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return Item
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new Item(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return Item
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new Item(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getSku());
        $this->assertNotNull($obj->getName());
        $this->assertNotNull($obj->getDescription());
        $this->assertNotNull($obj->getQuantity());
        $this->assertNotNull($obj->getPrice());
        $this->assertNotNull($obj->getCurrency());
        $this->assertNotNull($obj->getTax());
        $this->assertNotNull($obj->getUrl());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param Item $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals("TestSample", $obj->getSku());
        $this->assertEquals("TestSample", $obj->getName());
        $this->assertEquals("TestSample", $obj->getDescription());
        $this->assertEquals("12.34", $obj->getQuantity());
        $this->assertEquals("12.34", $obj->getPrice());
        $this->assertEquals("TestSample", $obj->getCurrency());
        $this->assertEquals("12.34", $obj->getTax());
        $this->assertEquals("http://www.google.com", $obj->getUrl());
    }
}
