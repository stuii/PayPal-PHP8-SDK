<?php

namespace PayPal\Test\Handler;

use PayPal\Auth\OAuthTokenCredential;
use PayPal\Core\PayPalHttpConfig;
use PayPal\Handler\OAuthHandler;
use PayPal\Rest\ApiContext;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class OauthHandlerTest extends TestCase
{

    /**
     * @var OauthHandlerInterface
     */
    public $handler;

    /**
     * @var PayPalHttpConfig
     */
    public $httpConfig;

    /**
     * @var ApiContext
     */
    public $apiContext;

    /**
     * @var array
     */
    public $config = [];

    public function setUp(): void
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                'clientId',
                'clientSecret'
            )
        );
    }

    public static function modeProvider()
    {
        return array(
            array(array('mode' => 'sandbox')),
            array(array('mode' => 'live')),
            array(array('mode' => 'sandbox', 'oauth.EndPoint' => 'http://localhost/')),
            array(array('mode' => 'sandbox', 'service.EndPoint' => 'http://service.localhost/'))
        );
    }


    /**
     * @param $configs
     */
    #[DataProvider('modeProvider')]
    public function testGetEndpoint($configs)
    {
        $this->expectNotToPerformAssertions();
        $config = $configs + array(
                'cache.enabled' => true,
                'http.headers.header1' => 'header1value'
            );
        $this->apiContext->setConfig($config);
        $this->httpConfig = new PayPalHttpConfig(null, 'POST', $config);
        $this->handler = new OAuthHandler($this->apiContext);
        $this->handler->handle($this->httpConfig, null, $this->config);
    }
}
