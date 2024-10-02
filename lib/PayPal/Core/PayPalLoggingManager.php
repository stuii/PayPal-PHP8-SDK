<?php /** @noinspection UnusedConstructorDependenciesInspection */

/** @noinspection PhpPropertyOnlyWrittenInspection */

namespace PayPal\Core;

use PayPal\Log\PayPalDefaultLogFactory;
use PayPal\Log\PayPalLogFactory;
use Psr\Log\LoggerInterface;

class PayPalLoggingManager
{
    private static array $instances = [];

    private LoggerInterface $logger;

    private string $loggerName;

    public static function getInstance(string $loggerName = __CLASS__): self
    {
        if (array_key_exists($loggerName, self::$instances)) {
            return self::$instances[$loggerName];
        }
        $instance = new self($loggerName);
        self::$instances[$loggerName] = $instance;
        return $instance;
    }

    private function __construct(string $loggerName)
    {
        $factoryInstance = new PayPalDefaultLogFactory();
        $this->logger = $factoryInstance->getLogger($loggerName);
        $this->loggerName = $loggerName;
    }

    public function error(string $message): void
    {
        $this->logger->error($message);
    }

    public function warning(string $message): void
    {
        $this->logger->warning($message);
    }

    public function info(string $message): void
    {
        $this->logger->info($message);
    }

    public function fine(string$message): void
    {
        $this->info($message);
    }

    public function debug(string $message): void
    {
        $this->logger->debug($message);
    }
}
