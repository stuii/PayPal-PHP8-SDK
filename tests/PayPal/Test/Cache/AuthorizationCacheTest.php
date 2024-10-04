<?php

namespace PayPal\Test\Cache;

use PayPal\Cache\AuthorizationCache;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;

/**
 * Test class for AuthorizationCacheTest.
 *
 */
class AuthorizationCacheTest extends TestCase
{
    const CACHE_FILE = 'tests/var/test.cache';

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
    }

    public static function EnabledProvider()
    {
        return array(
            array(array('cache.enabled' => 'true'), true),
            array(array('cache.enabled' => true), true),
        );
    }

    public static function CachePathProvider()
    {
        return array(
            array(array('cache.FileName' => 'temp.cache'), 'temp.cache')
        );
    }

    #[DataProvider('EnabledProvider')]
    public function testIsEnabled($config, $expected)
    {
        $result = AuthorizationCache::isEnabled($config);
        $this->assertEquals($expected, $result);
    }

    #[DataProvider('CachePathProvider')]
    public function testCachePath($config, $expected)
    {
        $result = AuthorizationCache::cachePath($config);
        $this->assertStringContainsString($expected, $result);
    }

    public function testCacheDisabled()
    {
        $this->expectNotToPerformAssertions();
        // 'cache.enabled' => true,
        AuthorizationCache::push(array('cache.enabled' => false), 'clientId', 'accessToken', 123, 123);
        AuthorizationCache::pull(array('cache.enabled' => false), 'clientId');
    }

    public function testCachePush()
    {
        AuthorizationCache::push(array('cache.enabled' => true, 'cache.FileName' => AuthorizationCacheTest::CACHE_FILE), 'clientId', 'accessToken', 123, 123);
        $contents = file_get_contents(AuthorizationCacheTest::CACHE_FILE);
        $tokens = json_decode($contents, true);
        $this->assertNotNull($contents);
        $this->assertEquals('clientId', $tokens['clientId']['clientId']);
        $this->assertEquals('accessToken', $tokens['clientId']['accessTokenEncrypted']);
        $this->assertEquals(123, $tokens['clientId']['tokenCreateTime']);
        $this->assertEquals(123, $tokens['clientId']['tokenExpiresIn']);
    }

    public function testCachePullNonExisting()
    {
        $result = AuthorizationCache::pull(array('cache.enabled' => true, 'cache.FileName' => AuthorizationCacheTest::CACHE_FILE), 'clientIdUndefined');
        $this->assertNull($result);
    }

    #[Depends('testCachePush')]
    public function testCachePull()
    {
        $result = AuthorizationCache::pull(array('cache.enabled' => true, 'cache.FileName' => AuthorizationCacheTest::CACHE_FILE), 'clientId');
        $this->assertNotNull($result);
        $this->assertEquals('clientId', $result['clientId']);
        $this->assertEquals('accessToken', $result['accessTokenEncrypted']);
        $this->assertEquals(123, $result['tokenCreateTime']);
        $this->assertEquals(123, $result['tokenExpiresIn']);

        unlink(AuthorizationCacheTest::CACHE_FILE);
    }
}
