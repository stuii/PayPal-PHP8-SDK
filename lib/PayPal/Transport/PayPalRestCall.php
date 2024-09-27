<?php /** @noinspection PhpOptionalBeforeRequiredParametersInspection */

namespace PayPal\Transport;

use PayPal\Core\PayPalHttpConfig;
use PayPal\Core\PayPalHttpConnection;
use PayPal\Exception\PayPalConfigurationException;
use PayPal\Exception\PayPalConnectionException;
use Paypal\Handler\PayPalHandlerInterface;
use PayPal\Rest\ApiContext;

class PayPalRestCall
{
    private ApiContext $apiContext;


    public function __construct(ApiContext $apiContext)
    {
        $this->apiContext = $apiContext;
    }

    /**
     * @throws PayPalConfigurationException
     * @throws PayPalConnectionException
     */
    public function execute(array $handlers = [], string $path, string $method, string $data = '', ?array $headers = []): bool|string
    {
        $config = $this->apiContext->getConfig();
        $httpConfig = new PayPalHttpConfig(null, $method, $config);
        $headers = $headers ?: [];
        $httpConfig->setHeaders($headers +
            [
                'Content-Type' => 'application/json',
            ]
        );

        // if proxy set via config, add it
        if (!empty($config['http.Proxy'])) {
            $httpConfig->setHttpProxy($config['http.Proxy']);
        }

        /** @var PayPalHandlerInterface $handler */
        foreach ($handlers as $handler) {
            if (!is_object($handler)) {
                $handler = new $handler($this->apiContext);
            }
            $handler->handle($httpConfig, $data, ['path' => $path, 'apiContext' => $this->apiContext,]);
        }
        return (new PayPalHttpConnection($httpConfig, $config))->execute($data);
    }
}
