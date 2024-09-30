<?php

namespace PayPal\Core;

use Exception;
use JsonException;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConfigurationException;
use PayPal\Exception\PayPalInvalidCredentialException;
use ReflectionException;

class PayPalCredentialManager
{
    private static self $instance;

    private array $credentialHashmap = [];

    private ?string $defaultAccountName = null;

    /**
     * @throws Exception
     */
    private function __construct($config)
    {
        try {
            $this->initCredential($config);
        } catch (Exception $e) {
            $this->credentialHashmap = [];
            throw $e;
        }
    }

    /**
     * @throws Exception
     */
    public static function getInstance(?array $config = null): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self($config ?? []);
        }
        return self::$instance;
    }

    /**
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     */
    private function initCredential(array $config): void
    {
        $suffix = 1;
        $prefix = 'acct';

        $acctConfig = [];
        foreach ($config as $k => $v) {
            if (str_contains($k, $prefix)) {
                $acctConfig[$k] = $v;
            }
        }
        $credArr = $acctConfig;

        $arr = [];
        foreach ($config as $key => $value) {
            $pos = strpos($key, '.');
            if (str_contains($key, 'acct')) {
                $arr[] = substr($key, 0, $pos);
            }
        }
        $arrayPartKeys = array_unique($arr);

        $key = $prefix . $suffix;
        $userName = null;
        while (in_array($key, $arrayPartKeys, true)) {
            if (isset($credArr[$key . '.ClientId'], $credArr[$key . '.ClientSecret'])) {
                $userName = $key;
                $this->credentialHashmap[$userName] = new OAuthTokenCredential(
                    $credArr[$key . '.ClientId'],
                    $credArr[$key . '.ClientSecret']
                );
            }
            if ($userName && $this->defaultAccountName === null) {
                if (array_key_exists($key . '.UserName', $credArr)) {
                    $this->defaultAccountName = $credArr[$key . '.UserName'];
                } else {
                    $this->defaultAccountName = $key;
                }
            }
            $suffix++;
            $key = $prefix . $suffix;
        }
    }

    public function setCredentialObject(OAuthTokenCredential $credential, ?string $userId = null, bool $default = true): self
    {
        $key = $userId ?? 'default';
        $this->credentialHashmap[$key] = $credential;
        if ($default) {
            $this->defaultAccountName = $key;
        }
        return $this;
    }

    /**
     * @param null $userId
     * @throws PayPalInvalidCredentialException
     */
    public function getCredentialObject($userId = null): OAuthTokenCredential
    {
        if ($userId === null && array_key_exists($this->defaultAccountName, $this->credentialHashmap)) {
            $credObj = $this->credentialHashmap[$this->defaultAccountName];
        } elseif (array_key_exists($userId, $this->credentialHashmap)) {
            $credObj = $this->credentialHashmap[$userId];
        }

        if (empty($credObj)) {
            throw new PayPalInvalidCredentialException('Credential not found for ' .  ($userId ?: ' default user') .
            '. Please make sure your configuration/APIContext has credential information');
        }
        return $credObj;
    }

    /**
     * Disabling __clone call
     * @noinspection PhpNoReturnAttributeCanBeAddedInspection
     */
    public function __clone()
    {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
}
