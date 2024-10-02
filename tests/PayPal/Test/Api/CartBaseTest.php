<?php

namespace PayPal\Test\Api;

use InvalidArgumentException;
use JsonException;
use PayPal\Api\CartBase;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class CartBase
 *
 * @package PayPal\Test\Api
 */
class CartBaseTest extends TestCase
{
    /**
     * Gets Json String of Object CartBase
     * @return string
     */
    public static function getJson()
    {
        return '{"reference_id":"TestSample","amount":' .AmountTest::getJson() . ',"payee":' .PayeeTest::getJson() . ',"description":"TestSample","note_to_payee":"TestSample","custom":"TestSample","invoice_number":"TestSample","purchase_order":"TestSample","soft_descriptor":"TestSample","payment_options":' .PaymentOptionsTest::getJson() . ',"item_list":' .ItemListTest::getJson() . ',"notify_url":"http://www.google.com","order_url":"http://www.google.com"}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return CartBase
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new CartBase(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return CartBase
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new CartBase(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getReferenceId());
        $this->assertNotNull($obj->getAmount());
        $this->assertNotNull($obj->getPayee());
        $this->assertNotNull($obj->getDescription());
        $this->assertNotNull($obj->getNoteToPayee());
        $this->assertNotNull($obj->getCustom());
        $this->assertNotNull($obj->getInvoiceNumber());
        $this->assertNotNull($obj->getPurchaseOrder());
        $this->assertNotNull($obj->getSoftDescriptor());
        $this->assertNotNull($obj->getPaymentOptions());
        $this->assertNotNull($obj->getItemList());
        $this->assertNotNull($obj->getNotifyUrl());
        $this->assertNotNull($obj->getOrderUrl());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param CartBase $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals("TestSample", $obj->getReferenceId());
        $this->assertEquals($obj->getAmount(), AmountTest::getObject());
        $this->assertEquals($obj->getPayee(), PayeeTest::getObject());
        $this->assertEquals("TestSample", $obj->getDescription());
        $this->assertEquals("TestSample", $obj->getNoteToPayee());
        $this->assertEquals("TestSample", $obj->getCustom());
        $this->assertEquals("TestSample", $obj->getInvoiceNumber());
        $this->assertEquals("TestSample", $obj->getPurchaseOrder());
        $this->assertEquals("TestSample", $obj->getSoftDescriptor());
        $this->assertEquals($obj->getPaymentOptions(), PaymentOptionsTest::getObject());
        $this->assertEquals($obj->getItemList(), ItemListTest::getObject());
        $this->assertEquals("http://www.google.com", $obj->getNotifyUrl());
        $this->assertEquals("http://www.google.com", $obj->getOrderUrl());
    }
}
