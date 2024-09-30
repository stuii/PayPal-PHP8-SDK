<?php

namespace PayPal\Common;

use PayPal\Exception\PayPalConfigurationException;
use ReflectionException;
use ReflectionMethod;
use RuntimeException;

class ReflectionUtil
{
    /**
     * @var array<ReflectionMethod>
     */
    private static array $propertiesReflection = [];

    private static array $propertiesType = [];

    /**
     * @throws PayPalConfigurationException
     * @throws ReflectionException
     */
    public static function getPropertyClass(string $class, string $propertyName): ?string
    {
        if ($class === PayPalModel::class) {
            // Make it generic if PayPalModel is used for generating this
            return PayPalModel::class;
        }

        // If the class doesn't exist, or the method doesn't exist, return null.
        if (!class_exists($class) || !method_exists($class, self::getter($class, $propertyName))) {
            return null;
        }

        $reflection = new \ReflectionProperty($class, $propertyName);
        if ($reflection->hasType()) {
            return $reflection->getType()?->getName();
        }
        return null;
    }

    /**
     * @throws PayPalConfigurationException
     * @throws ReflectionException
     */
    public static function isPropertyClassArray(string $class, string $propertyName): ?bool
    {
        // If the class doesn't exist, or the method doesn't exist, return null.
        if (!class_exists($class) || !method_exists($class, self::getter($class, $propertyName))) {
            return null;
        }
        $reflection = new \ReflectionProperty($class, $propertyName);
        return $reflection->getType()?->getName() === 'array';
    }

    /**
     * @throws ReflectionException
     */
    public static function propertyAnnotations(string|object $class, string $propertyName): ?array
    {
        $class = is_object($class) ? get_class($class) : $class;
        if (!class_exists('ReflectionProperty')) {
            throw new RuntimeException('Property type of ' . $class . "::$propertyName cannot be resolved");
        }

        if ($annotations =& self::$propertiesType[$class][$propertyName]) {
            return $annotations;
        }

        if (!($reflection =& self::$propertiesReflection[$class][$propertyName])) {
            $getter = self::getter($class, $propertyName);
            $reflection = new ReflectionMethod($class, $getter);
            self::$propertiesReflection[$class][$propertyName] = $reflection;
        }

        // todo: smarter regexp
        if (!preg_match_all(
            '~\@([^\s@\(]+)[\t ]*(?:\(?([^\n@]+)\)?)?~i',
            $reflection->getDocComment(),
            $annots,
            PREG_PATTERN_ORDER)) {
            return null;
        }
        foreach ($annots[1] as $i => $annot) {
            $annotations[strtolower($annot)] = empty($annots[2][$i]) ? true : rtrim($annots[2][$i], " \t\n\r)");
        }

        return $annotations;
    }

    private static function replace_callback(array $match): string
    {
        return ucwords($match[2]);
    }

    public static function getter(string $class, string $propertyName): string
    {
        return method_exists($class, "get" . ucfirst($propertyName)) ?
            "get" . ucfirst($propertyName) :
            "get" . preg_replace_callback("/([_\-\s]?([a-z0-9]+))/", self::replace_callback(...), $propertyName);
    }
}
