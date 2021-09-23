# Array AnyDataset

[![Opensource ByJG](https://img.shields.io/badge/opensource-byjg.com-brightgreen.svg)](http://opensource.byjg.com)
[![Build Status](https://travis-ci.org/byjg/anydataset-array.svg?branch=master)](https://travis-ci.org/byjg/anydataset-array)

## Description

Array abstraction dataset. Anydataset is an agnostic data source abstraction layer in PHP. 

See more about Anydataset [here](https://github.com/byjg/anydataset).

## Examples

### Simple Manipulation

```php
<?php
$array = ["A", "B", "C"];

$dataset = new \ByJG\AnyDataset\Lists\ArrayDataset($array);

$iterator = $dataset->getIterator();
foreach ($iterator as $row) {
    echo $row->get('__id');     // Print 0, 1, 2
    echo $row->get('__key');    // Print 0, 1, 2
    echo $row->get('value');    // Print "A", "B", "C"
}
```

### Associative Arrays

```php
<?php
$array = ["A" => "ProdA", "B" => "ProdB", "C" => "ProdC"];

$dataset = new \ByJG\AnyDataset\Lists\ArrayDataset($array);

$iterator = $dataset->getIterator();
foreach ($iterator as $row) {
    echo $row->get('__id');     // Print 0, 1, 2
    echo $row->get('__key');    // Print "A", "B", "C"
    echo $row->get('value');    // Print "ProdA", "ProdB", "ProdC"
}
```

### Array of objects

```php
<?php
class Name {
    public $name;
    public $surname;

    public function __construct($name, $surname) {
        $this->name = $name;
        $this->surname = $surname;
    }
}
$array = [
    "A" => new Name("Joao", "Gilberto"),
    "B" => new Name("John", "Doe"),
    "C" => new Name("Mary", "Jane")
];

$dataset = new \ByJG\AnyDataset\Lists\ArrayDataset($array);

$iterator = $dataset->getIterator();
foreach ($iterator as $row) {
    echo $row->get('__id');     // Print 0, 1, 2
    echo $row->get('__key');    // Print A, B, C
    echo $row->get('__class');  // Print \Name
    echo $row->get('name');     // Print "Joao", "John", "Mary"
    echo $row->get('surname');  // Print "Gilberto", "Doe", "Jane"
}
```

### Filtering results

```php
<?php
class Name {
    public $name;
    public $surname;

    public function __construct($name, $surname) {
        $this->name = $name;
        $this->surname = $surname;
    }
}
$array = [
    "A" => new Name("Joao", "Gilberto"),
    "B" => new Name("John", "Doe"),
    "C" => new Name("Mary", "Jane")
];

$dataset = new \ByJG\AnyDataset\Lists\ArrayDataset($array);

$filter = new \ByJG\AnyDataset\Core\IteratorFilter();
$filter->addRelation("surname", \ByJG\AnyDataset\Core\Enum\Relation::EQUAL, "Doe");
$iterator = $dataset->getIterator($filter);
foreach ($iterator as $row) {
    echo $row->get('__id');     // Print 1
    echo $row->get('__key');    // Print B
    echo $row->get('__class');  // Print \Name
    echo $row->get('name');     // Print "John"
    echo $row->get('surname');  // Print "Doe"
}
```

## Install

Just type: 

```bash
composer require "byjg/anydataset-array=4.0.*"
```

## Running Unit tests


```php
vendor/bin/phpunit
```

----
[Open source ByJG](http://opensource.byjg.com)
