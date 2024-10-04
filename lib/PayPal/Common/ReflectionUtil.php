<?php

namespace PayPal\Common;

use PayPal\Exception\PayPalConfigurationException;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use ReflectionProperty;
use ReflectionType;
use RuntimeException;

class ReflectionUtil
{
    /**
     * @var array<ReflectionMethod>
     */
    private static array $propertiesReflection = [];

    private static array $propertiesType = [];

    /**
     * @throws ReflectionException
     */
    public static function getPropertyClass(string $class, string $propertyName): ?string
    {
        $propertyName = PayPalModel::convertToCamelCase($propertyName);
        if ($class === PayPalModel::class) {
            // Make it generic if PayPalModel is used for generating this
            return PayPalModel::class;
        }

        $reflection = self::getRealReflectionProperty($class, $propertyName);

        if ($reflection?->hasType() === true) {
            if ($reflection?->getType()?->getName() === 'array') {
                $found = preg_match('/\/\*\*(.*)array<(.*)>(.*)\*\//m', $reflection->getDocComment(), $matches);
                return $found === 0 ? $reflection->getType()?->getName() : $matches[2];
            }
            return $reflection?->getType()?->getName();
        }
        return null;
    }

    /**
     * @throws ReflectionException
     */
    public static function propertyExists(string $class, string $propertyName): ?string
    {
        $propertyName = PayPalModel::convertToCamelCase($propertyName);

        $reflection = self::getRealReflectionProperty($class, $propertyName);

        return $reflection !== null;
    }

    /**
     * @throws ReflectionException
     */
    public static function getRealReflectionProperty(string $class, string $propertyName): ?ReflectionProperty
    {
        $depth = 1;
        while($depth < 2) {
            if (!class_exists($class)) {
                return null;
            }
            $reflectionClass = new ReflectionClass($class);
            if ($reflectionClass->hasProperty($propertyName)) {
                return new ReflectionProperty($class, $propertyName);
            }
            $parentClass = $reflectionClass->getParentClass();
            if (!$parentClass) {
                return null;
            }
            $class = $parentClass->getName();
            ++$depth;
        }
        return null;
    }

    /**
     * @throws ReflectionException
     */
    public static function isPropertyClassArray(string $class, string $propertyName): ?bool
    {
        $propertyName = PayPalModel::convertToCamelCase($propertyName);
        $reflection = self::getRealReflectionProperty($class, $propertyName);
        return $reflection->getType()?->getName() === 'array'
            && preg_match('/\/\*\*(.*)array<(.*)>(.*)\*\//m', $reflection->getDocComment());
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
