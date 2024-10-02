<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class ItemList
 *
 * @package PayPal\Test\Api
 */
class ItemListTest extends TestCase
{
    /**
     * Gets Json String of Object ItemList
     * @return string
     */
    public static function getJson()
    {
        return '{"items":[' . ItemTest::getJson() . '],"shipping_address":' . ShippingAddressTest::getJson() . ',"shipping_method":"TestSample","shipping_phone_number":"TestSample"}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return ItemList
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new ItemList(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return ItemList
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new ItemList(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getItems());
        $this->assertNotNull($obj->getShippingAddress());
        $this->assertNotNull($obj->getShippingMethod());
        $this->assertNotNull($obj->getShippingPhoneNumber());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param ItemList $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getItems(), array(ItemTest::getObject()));
        $this->assertEquals($obj->getShippingAddress(), ShippingAddressTest::getObject());
        $this->assertEquals("TestSample", $obj->getShippingMethod());
        $this->assertEquals("TestSample", $obj->getShippingPhoneNumber());
    }

    /**
     * @param ItemList $obj
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    #[Depends('testSerializationDeserialization')]
    public function testAddRemove($obj)
    {
		$item2 = new Item(ItemTest::getJSON());
		$item2->setSku('TestSample2');
        $item3 = new Item(ItemTest::getJSON());
		$item3->setSku('TestSample3');
		$obj->addItem($item2);
		$obj->addItem($item3);
		$this->assertCount(3, $obj->getItems());
		$obj->removeItem($item2);
		
		$this->assertCount(2, $obj->getItems());
		$this->assertStringContainsString('"items":[', $obj->toJSON());
    }
}
