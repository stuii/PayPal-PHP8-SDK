<?php /** @noinspection ALL */

namespace PayPal\Core;

class PayPalConfigManager
{

    private array $configs = [];

    private static self $instance;

    /**
     * Private Constructor
     */
    private function __construct()
    {
        if (defined('PP_CONFIG_PATH')) {
            $configFile = constant('PP_CONFIG_PATH') . '/sdk_config.ini';
        } else {
            $configFile = implode(DIRECTORY_SEPARATOR, [__DIR__, '..', 'config', 'sdk_config.ini']);
        }
        if (file_exists($configFile)) {
            $this->addConfigFromIni($configFile);
        }
    }

    public static function getInstance(): static
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function addConfigFromIni(string $fileName): static
    {
        if ($configs = parse_ini_file($fileName)) {
            $this->addConfigs($configs);
        }
        return $this;
    }

    public function addConfigs($configs = []): static
    {
        $this->configs = $configs + $this->configs;
        return $this;
    }

    public function get(string $searchKey): array
    {
        if (array_key_exists($searchKey, $this->configs)) {
            return $this->configs[$searchKey];
        }

        $arr = [];
        if ($searchKey !== '') {
            foreach ($this->configs as $k => $v) {
                if (str_contains($k, $searchKey)) {
                    $arr[$k] = $v;
                }
            }
        }

        return $arr;
    }

    public function getIniPrefix(?string $userId = null): array|string
    {
        if ($userId === null) {
            $arr = [];
            foreach ($this->configs as $key => $value) {
                $pos = strpos($key, '.');
                if (str_contains($key, "acct")) {
                    $arr[] = substr($key, 0, $pos);
                }
            }
            return array_unique($arr);
        }

        $iniPrefix = array_search($userId, $this->configs, true);
        $pos = strpos($iniPrefix, '.');
        return substr($iniPrefix, 0, $pos);
    }

    public function getConfigHashmap(): array
    {
        return $this->configs;
    }

    public function __clone()
    {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
}