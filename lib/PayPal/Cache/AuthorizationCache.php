<?php /** @noinspection TypeUnsafeComparisonInspection */
/** @noinspection PhpConditionAlreadyCheckedInspection */

/** @noinspection PhpOptionalBeforeRequiredParametersInspection */

namespace PayPal\Cache;

use Exception;
use JsonException;
use PayPal\Core\PayPalConfigManager;
use PayPal\Validation\JsonValidator;
use RuntimeException;

abstract class AuthorizationCache
{
    public static string $CACHE_PATH = '/../../../var/auth.cache';

    /**
     * @throws JsonException
     */
    public static function pull(?array $config = null, ?string $clientId = null): mixed
    {
        // Return if not enabled
        if (!self::isEnabled($config ?? [])) {
            return null;
        }

        $tokens = null;
        $cachePath = self::cachePath($config);
        if (file_exists($cachePath)) {
            // Read from the file
            $cachedToken = file_get_contents($cachePath);
            if ($cachedToken && JsonValidator::validate($cachedToken, true)) {
                $tokens = json_decode($cachedToken, true, 512, JSON_THROW_ON_ERROR);
                if ($clientId && is_array($tokens) && array_key_exists($clientId, $tokens)) {
                    // If client ID is found, just send in that data only
                    return $tokens[$clientId];
                }

                if ($clientId) {
                    // If client ID is provided, but no key in persisted data found matching it.
                    return null;
                }
            }
        }
        return $tokens;
    }

    /**
     * @throws Exception
     */
    public static function push(
        ?array $config = null,
        ?string $clientId,
        string $accessToken,
        float $tokenCreateTime,
        int $tokenExpiresIn
    ): void {
        // Return if not enabled
        if (!self::isEnabled($config)) {
            return;
        }

        $cachePath = self::cachePath($config);
        if (
            !is_dir(dirname($cachePath))
            && !mkdir($concurrentDirectory = dirname($cachePath), 0755, true)
            && !is_dir($concurrentDirectory)
        ) {
            throw new RuntimeException("Failed to create directory at $cachePath");
        }

        // Reads all the existing persisted data
        $tokens = self::pull();
        $tokens = $tokens ?: [];
        if (is_array($tokens)) {
            $tokens[$clientId] = [
                'clientId' => $clientId,
                'accessTokenEncrypted' => $accessToken,
                'tokenCreateTime' => $tokenCreateTime,
                'tokenExpiresIn' => $tokenExpiresIn,
            ];
        }
        if (!file_put_contents($cachePath, json_encode($tokens, JSON_THROW_ON_ERROR))) {
            throw new RuntimeException("Failed to write cache");
        }
    }

    public static function isEnabled(array $config): bool
    {
        $value = self::getConfigValue('cache.enabled', $config);
        return !empty($value) && ($value == true || trim($value) === 'true');
    }
    
    /**
     * Returns the cache file path
     *
     * @param $config
     * @return string
     */
    public static function cachePath($config): string
    {
        $cachePath = self::getConfigValue('cache.FileName', $config);
        return empty($cachePath) ? __DIR__ . self::$CACHE_PATH : $cachePath;
    }

    /**
     * Returns the Value of the key if found in given config, or from PayPal Config Manager
     * Returns null if not found
     *
     * @param $key
     * @param $config
     * @return null|string
     */
    private static function getConfigValue($key, $config): ?string
    {
        $config = ($config && is_array($config)) ? $config : PayPalConfigManager::getInstance()->getConfigHashmap();
        return (array_key_exists($key, $config)) ? trim($config[$key]) : null;
    }
}
