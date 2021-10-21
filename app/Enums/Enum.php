<?php

namespace App\Enums;

abstract class Enum {

    private static $constCacheArray = NULL;

    /**
     * Return the Properties of the Enum
     * 
     * @return string[] Properties of the enum
     */
    public static function all() : array 
    {
        if (self::$constCacheArray == NULL) {
            self::$constCacheArray = [];
        }
        $calledClass = get_called_class();
        if (!array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new \ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }
        return self::$constCacheArray[$calledClass];
    }


    /**
     * Returns all the Keys of the Enum
     * 
     * @return string[] keys of enum
     */
    public static function keys() : array 
    {
        return array_keys(self::all());
    }

    /**
     * Returns all the Value of the Enum
     * 
     * @return mixed[] values of enum
     */
    public static function values() : array
    {
        return array_values(self::all());
    }

    /**
     * Check if the given name is valid property of Enum
     * 
     * @param   string  $name       Name to be validated
     * @param   bool    $string     Optional | Default = false.
     *                              Whether or not the validator
     *                              Will be case-sensitive.
     * 
     * @return  bool    Result of Validation
     */
    public static function isValidName(string $name, bool $strict = false) : bool 
    {
        $constants = self::all();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        $keys = array_map('strtolower', array_keys($constants));
        return in_array(strtolower($name), $keys);
    }


    /**
     * Check if the given value belongs to Enum
     * 
     * @param   mixed   $value  The value to be verify
     * @param   bool    $strick Whether or not the validator is case-sensitive
     * 
     * @return  bool    Result of Validation
     */
    public static function isValidValue(mixed $value, bool $strict = true) : bool {
        $values = array_values(self::all());
        return in_array($value, $values, $strict);
    }
}