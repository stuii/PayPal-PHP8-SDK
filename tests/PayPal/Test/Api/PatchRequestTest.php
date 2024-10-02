<?php

namespace PayPal\Test\Api;

use JsonException;
use PayPal\Common\PayPalModel;
use PayPal\Api\PatchRequest;
use PayPal\Exception\PayPalConfigurationException;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * Class PatchRequest
 *
 * @package PayPal\Test\Api
 */
class PatchRequestTest extends TestCase
{
    /**
     * Gets Json String of Object PatchRequest
     * @return string
     */
    public static function getJson()
    {
        return '{"patches":[' .PatchTest::getJson() . ']}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return PatchRequest
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public static function getObject()
    {
        return new PatchRequest(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return PatchRequest
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testSerializationDeserialization()
    {
        $obj = new PatchRequest(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getPatches());
        return $obj;
    }

    /**
     * @param PatchRequest $obj
     */
    #[Depends('testSerializationDeserialization')]
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getPatches(), [PatchTest::getObject()]);
    }
}
