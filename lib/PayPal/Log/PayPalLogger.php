<?php

namespace PayPal\Log;

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

    private string $loggingLevel;

    private ?string $loggerFile = null;

    private bool $isLoggingEnabled = false;

    private string $loggerName;

    public function __construct(string $className)
    {
        $this->loggerName = $className;
        $this->loggingLevel = LogLevel::DEBUG;
    }

    public function log($level, string|Stringable $message, array $context = []): void
    {
        if ($this->isLoggingEnabled && array_search($level, $this->loggingLevels, true) <= array_search($this->loggingLevel, $this->loggingLevels, true)) {
            error_log('[' . date('d-m-Y H:i:s') . '] ' . $this->loggerName . ' : ' . strtoupper($level) . ": $message\n", 3, $this->loggerFile);
        }
    }
}
