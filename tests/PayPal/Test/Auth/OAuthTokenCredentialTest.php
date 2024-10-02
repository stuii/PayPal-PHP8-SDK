<?php

namespace PayPal\Test\Auth;

use PayPal\Auth\OAuthTokenCredential;
use PayPal\Cache\AuthorizationCache;
use PayPal\Core\PayPalConfigManager;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;
use PayPal\Test\Cache\AuthorizationCacheTest;
use PayPal\Test\Constants;
use PHPUnit\Framework\TestCase;

class OAuthTokenCredentialTest extends TestCase
{

    /**
     * @group integration
     */
    public function testGetAccessToken()
    {
        $cred = new OAuthTokenCredential(Constants::CLIENT_ID, Constants::CLIENT_SECRET);
        $this->assertEquals(Constants::CLIENT_ID, $cred->getClientId());
        $this->assertEquals(Constants::CLIENT_SECRET, $cred->getClientSecret());
        $config = PayPalConfigManager::getInstance()->getConfigHashmap();
        $token = $cred->getAccessToken($config);
        $this->assertNotNull($token);

        // Check that we get the same token when issuing a new call before token expiry
        $newToken = $cred->getAccessToken($config);
        $this->assertNotNull($newToken);
        $this->assertEquals($token, $newToken);
    }

    /**
     * @group integration
     */
    public function testInvalidCredentials()
    {
        $this->expectException('PayPal\Exception\PayPalConnectionException');
        $cred = new OAuthTokenCredential('dummy', 'secret');
        $this->assertNull($cred->getAccessToken(PayPalConfigManager::getInstance()->getConfigHashmap()));
    }

    public function testGetAccessTokenUnit()
    {
        $config = array(
            'mode' => 'sandbox',
            'cache.enabled' => true,
            'cache.FileName' => AuthorizationCacheTest::CACHE_FILE
        );
        $cred = new OAuthTokenCredential('clientId', 'clientSecret');

        //{"clientId":{"clientId":"clientId","accessToken":"accessToken","tokenCreateTime":1421204091,"tokenExpiresIn":288000000}}
        AuthorizationCache::push($config, 'clientId', $cred->encrypt('accessToken'), 1421204091, 288000000);

        $apiContext = new ApiContext($cred);
        $apiContext->setConfig($config);
        $this->assertEquals('clientId', $cred->getClientId());
        $this->assertEquals('clientSecret', $cred->getClientSecret());
        $this->expectException(PayPalConnectionException::class);
        $result = $cred->getAccessToken($config);
    }
}
