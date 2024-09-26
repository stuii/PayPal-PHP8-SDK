<?php /** @noinspection PhpPropertyOnlyWrittenInspection */

namespace PayPal\Log;

use PayPal\Core\PayPalConfigManager;
use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;
use Stringable;

class PayPalLogger extends AbstractLogger
{

    private array $loggingLevels = [
        LogLevel::EMERGENCY,
        LogLevel::ALERT,
        LogLevel::CRITICAL,
        LogLevel::ERROR,
        LogLevel::WARNING,
        LogLevel::NOTICE,
        LogLevel::INFO,
        LogLevel::DEBUG,
    ];

    private LogLevel $loggingLevel;

    private ?string $loggerFile = null;

    private bool $isLoggingEnabled = true;

    private string $loggerName;

    public function __construct(string $className)
    {
        $this->loggerName = $className;
    }

    public function log($level, string|Stringable $message, array $context = []): void
    {
        if ($this->isLoggingEnabled && array_search($level, $this->loggingLevels, true) <= array_search($this->loggingLevel, $this->loggingLevels, true)) {
            error_log('[' . date('d-m-Y H:i:s') . '] ' . $this->loggerName . ' : ' . strtoupper($level) . ": $message\n", 3, $this->loggerFile);
        }
    }
}
