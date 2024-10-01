<?php

namespace PayPal\Test\Api;

use InvalidArgumentException;
use JsonException;
use PayPal\Api\RedirectUrls;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class RedirectUrls
 *
 * @package PayPal\Test\Api
 */
class RedirectUrlsTest extends TestCase
{
    /**
     * Gets Json String of Object RedirectUrls
     * @return string
     */
    public static function getJson()
    {
        return '{"return_url":"http://www.google.com","cancel_url":"http://www.google.com"}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return RedirectUrls
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new RedirectUrls(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return RedirectUrls
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new RedirectUrls(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getReturnUrl());
        $this->assertNotNull($obj->getCancelUrl());
        $this->assertJsonStringEqualsJsonString(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @param RedirectUrls $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals("http://www.google.com", $obj->getReturnUrl());
        $this->assertEquals("http://www.google.com", $obj->getCancelUrl());
    }
}
