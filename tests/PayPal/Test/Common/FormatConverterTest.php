<?php
namespace PayPal\Test\Common;

use PayPal\Api\Amount;
use PayPal\Api\Currency;
use PayPal\Api\Details;
use PayPal\Api\InvoiceItem;
use PayPal\Api\Item;
use PayPal\Api\Tax;
use PayPal\Common\PayPalModel;
use PayPal\Test\Validation\NumericValidatorTest;
use PHPUnit\Framework\TestCase;

class FormatConverterTest extends TestCase
{

    public static function classMethodListProvider()
    {
        return array(
            array(new Item(), 'Price'),
            array(new Item(), 'Tax'),
            array(new Amount(), 'Total'),
            array(new Currency(), 'Value'),
            array(new Details(), 'Shipping'),
            array(new Details(), 'SubTotal'),
            array(new Details(), 'Tax'),
            array(new Details(), 'Fee'),
            array(new Details(), 'ShippingDiscount'),
            array(new Details(), 'Insurance'),
            array(new Details(), 'HandlingFee'),
            array(new Details(), 'GiftWrap'),
            array(new InvoiceItem(), 'Quantity'),
            array(new Tax(), 'Percent')
        );
    }

    public static function CurrencyListWithNoDecimalsProvider()
    {
        return array(
            array('JPY'),
            array('TWD'),
            array('HUF')
        );
    }

    public static function apiModelSettersProvider()
    {
        $provider = array();
        foreach (NumericValidatorTest::positiveProvider() as $value) {
            foreach (self::classMethodListProvider() as $method) {
                $provider[] = array_merge($method, array($value));
            }
        }
        return $provider;
    }

    public static function apiModelSettersInvalidProvider()
    {
        $provider = array();
        foreach (NumericValidatorTest::invalidProvider() as $value) {
            foreach (self::classMethodListProvider() as $method) {
                $provider[] = array_merge($method, array($value));
            }
        }
        return $provider;
    }

    /**
     * @dataProvider apiModelSettersProvider
     *
     * @param PayPalModel $class Class Object
     * @param string $method Method Name where the format is being applied
     * @param array $values array of ['input', 'expectedResponse'] is provided
     */
    public function testSettersOfKnownApiModel($class, $method, $values)
    {
        $obj = new $class();
        $setter = "set" . $method;
        $getter = "get" . $method;
        $result = $obj->$setter($values[0]);
        $this->assertEquals($values[1], $result->$getter());
    }

    /**
     * @dataProvider apiModelSettersInvalidProvider
     * @expectedException \InvalidArgumentException
     */
    public function testSettersOfKnownApiModelInvalid($class, $methodName, $values)
    {
        $obj = new $class();
        $setter = "set" . $methodName;
        $obj->$setter($values[0]);
    }
}
