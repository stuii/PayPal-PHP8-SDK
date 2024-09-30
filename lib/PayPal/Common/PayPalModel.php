<?php

namespace PayPal\Common;

use JsonException;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConfigurationException;
use PayPal\Validation\JsonValidator;
use ReflectionException;
use stdClass;

class PayPalModel
{
    protected static OAuthTokenCredential $credential;

    /** @deprecated  */
    public static function setCredential(OAuthTokenCredential $credential): void
    {
        self::$credential = $credential;
    }

    /**
     * @throws PayPalConfigurationException
     * @throws JsonException
     * @throws ReflectionException
     * @throws ReflectionException
     */
    public function __construct(array|string|null $data = null)
    {
        switch (gettype($data)) {
            case 'NULL':
                break;
            case 'string':
                JsonValidator::validate($data);
                $this->fromJson($data);
                break;
            case 'array':
                $this->fromArray($data);
                break;
            default:
        }
    }

    /**
     * @throws JsonException
     * @throws PayPalConfigurationException
     * @throws PayPalConfigurationException
     * @throws PayPalConfigurationException
     * @throws ReflectionException
     * @throws ReflectionException
     */
    public static function getList($data): self|array|null
    {
        // Return Null if Null
        if ($data === null) {
            return null;
        }

        if (is_a($data, get_class(new stdClass()))) {
            //This means, root element is object
            return new static(json_encode($data, JSON_THROW_ON_ERROR));
        }

        $list = [];

        if (is_array($data)) {
            $data = json_encode($data, JSON_THROW_ON_ERROR);
        }

        if (JsonValidator::validate($data)) {
            // It is valid JSON
            $decoded = json_decode($data, false, 512, JSON_THROW_ON_ERROR);
            if ($decoded === null) {
                return $list;
            }
            if (is_array($decoded)) {
                foreach ($decoded as $k => $v) {
                    $list[] = self::getList($v);
                }
            }
            if (is_a($decoded, get_class(new stdClass()))) {
                //This means, root element is object
                $list[] = new static(json_encode($decoded, JSON_THROW_ON_ERROR));
            }
        }

        return $list;
    }

    public function __get(string $key)
    {
        return $this->getValue($key);
    }

    public function __set(string $key, $value)
    {
        if (!is_array($value) && $value === null) {
            $this->__unset($key);
        } else {
            $this->assignValue($key, $value);
        }
    }

    private function convertToCamelCase(string $key): string
    {
        return str_replace(' ', '', ucwords(str_replace(array('_', '-'), ' ', $key)));
    }

    private function convertToSnake($camelCase): string
    {
        $result = '';

        for ($i = 0, $iMax = strlen($camelCase); $i < $iMax; $i++) {
            $char = $camelCase[$i];

            if (ctype_upper($char)) {
                $result .= '_' . strtolower($char);
            } else {
                $result .= $char;
            }
        }

        return ltrim($result, '_');
    }

    public function __isset(string $key): bool
    {
        return isset($this->$key);
    }

    public function __unset(string $key): void
    {
        unset($this->$key);
    }

    private function _convertToArray($param): PayPalModel|array
    {
        $ret = [];
        foreach ($param as $k => $v) {
            if ($v instanceof self) {
                $ret[$k] = $v->toArray();
            } elseif (is_array($v) && count($v) <= 0) {
                $ret[$k] = [];
            } elseif (is_array($v)) {
                $ret[$k] = $this->_convertToArray($v);
            } else {
                $ret[$k] = $v;
            }
        }
        // If the array is empty, which means an empty object,
        // we need to convert array to StdClass object to properly
        // represent JSON String
        if (count($ret) <= 0) {
            $ret = new PayPalModel();
        }
        return $ret;
    }

    /**
     * @throws PayPalConfigurationException
     * @throws ReflectionException
     * @throws ReflectionException
     */
    public function fromArray(array $arr): self
    {
        if (!empty($arr)) {
            // Iterate over each element in array
            foreach ($arr as $k => $v) {
                // If the value is an array, it means, it is an object after conversion
                // Determine the class of the object
                if (is_array($v) && ($clazz = ReflectionUtil::getPropertyClass(get_class($this), $k)) !== null) {
                    // If the value is an associative array, it means, it's an object. Just make recursive call to it.
                    if (empty($v)) {
                        if (ReflectionUtil::isPropertyClassArray(get_class($this), $k)) {
                            // It means, it is an array of objects.
                            $this->assignValue($k, []);
                            continue;
                        }
                        $o = new $clazz();
                        //$arr = [];
                        $this->assignValue($k, $o);
                    } elseif (ArrayUtil::isAssocArray($v)) {
                        /** @var self $o */
                        $o = new $clazz();
                        $o->fromArray($v);
                        $this->assignValue($k, $o);
                    } else {
                        // Else, value is an array of object/data
                        $arr = [];
                        // Iterate through each element in that array.
                        foreach ($v as $nk => $nv) {
                            if (is_array($nv)) {
                                $o = new $clazz();
                                $o->fromArray($nv);
                                $arr[$nk] = $o;
                            } else {
                                $arr[$nk] = $nv;
                            }
                        }
                        $this->assignValue($k, $arr);
                    }
                } else {
                    $this->assignValue($k, $v);
                }
            }
        }
        return $this;
    }

    private function assignValue($key, $value): void
    {
        $setter = 'set'. $this->convertToCamelCase($key);
        // If we find the setter, use that, otherwise use magic method.
        if (method_exists($this, $setter)) {
            $this->$setter($value);
        } else {
            $this->__set($key, $value);
        }
    }

    private function getValue($key): mixed
    {
        $getter = 'get'. $this->convertToCamelCase($key);
        // If we find the setter, use that, otherwise use magic method.
        if (method_exists($this, $getter)) {
            return $this->$getter();
        }
        return null;
    }

    /**
     * @throws JsonException
     * @throws PayPalConfigurationException
     * @throws ReflectionException
     * @throws ReflectionException
     */
    public function fromJson(string $json): self
    {
        return $this->fromArray(json_decode($json, true, 512, JSON_THROW_ON_ERROR));
    }

    public function toArray(): array
    {
        $reflect = new \ReflectionClass($this);
        $props = $reflect->getProperties(5);
        while ($reflect = $reflect->getParentClass()) {
            $props = [...$props, ...$reflect->getProperties(5)];
        }
        $properties = [];
        foreach ($props as $prop) {
            $propName = $prop->name;
            $properties[$this->convertToSnake($propName)] = $this->getValue($propName);
        }

        return $this->_convertToArray($properties);
    }

    /**
     * @throws JsonException
     */
    public function toJSON(int $options = 0): string
    {
        return json_encode($this->toArray(), JSON_THROW_ON_ERROR | $options | JSON_UNESCAPED_SLASHES);
    }

    /**
     * @throws JsonException
     */
    public function __toString(): string
    {
        return $this->toJSON(JSON_PRETTY_PRINT);
    }
}
