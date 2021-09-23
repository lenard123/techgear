<?php

namespace ByJG\AnyDataset\Lists;

use ByJG\AnyDataset\Core\GenericIterator;
use ByJG\AnyDataset\Core\IteratorFilter;
use UnexpectedValueException;

class ArrayDataset
{

    /**
     * @var array
     */
    protected $array;

    /**
     * Constructor Method
     *
     * @param array $array
     * @param string $fieldName
     */
    public function __construct($array, $fieldName = "value")
    {

        if (!is_array($array)) {
            throw new UnexpectedValueException("You need to pass an array");
        }

        $this->array = [];

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $this->array[$key] = $value;
            } elseif (!is_object($value)) {
                $this->array[$key] = array($fieldName => $value);
            } else {
                $result = array("__class" => get_class($value));
                $methods = get_class_methods($value);
                foreach ($methods as $method) {
                    if (strpos($method, "get") === 0) {
                        $result[substr($method, 3)] = $value->{$method}();
                    }
                }
                $this->array[$key] = $result;
                $props = get_object_vars($value);
                $this->array[$key] += $props;
            }
        }
    }

    /**
     * Return a GenericIterator
     *
     * @param IteratorFilter $filter
     * @return GenericIterator
     */
    public function getIterator($filter = null)
    {
        return new ArrayDatasetIterator($this->array, $filter);
    }
}
