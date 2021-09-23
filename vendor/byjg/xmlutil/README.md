# XmlUtil
[![Build Status](https://travis-ci.org/byjg/xmlutil.svg?branch=master)](https://travis-ci.org/byjg/xmlutil)

## Description

A utility class to make easy work with XML in PHP 

## Examples

### Create a new XML Document and add nodes

```php
$xml = \ByJG\Util\XmlUtil::createXmlDocumentFromStr('<root />');

$myNode = \ByJG\Util\XmlUtil::createChild($xml->documentElement, 'mynode');
\ByJG\Util\XmlUtil::createChild($myNode, 'subnode', 'text');
\ByJG\Util\XmlUtil::createChild($myNode, 'subnode', 'more text');
$otherNode = \ByJG\Util\XmlUtil::createChild($myNode, 'othersubnode', 'other text');
\ByJG\Util\XmlUtil::addAttribute($otherNode, 'attr', 'value');
```

will produce the follow xml

```xml
<?xml version="1.0" encoding="utf-8"?>
<root>
    <mynode>
        <subnode>text</subnode>
        <subnode>more text</subnode>
        <othersubnode attr="value">other text</othersubnode>
    </mynode>
</root>
```

### Convert to array

```php
$array = \ByJG\Util\XmlUtil::xml2Array($xml);
```

### Select a single node based on XPath

```php
$node = \ByJG\Util\XmlUtil::selectSingleNode($xml, '//subnode');
```

### Select all nodes based on XPath

```php
$nodeList = \ByJG\Util\XmlUtil::selectNodes($myNode, '//subnode');
```


### Working with xml namespaces

Add a namespace to the document

```php
\ByJG\Util\XmlUtil::addNamespaceToDocument($xml, 'my', 'http://www.example.com/mytest/');
```

will produce

```xml
<?xml version="1.0" encoding="utf-8"?>
<root xmlns:my="http://www.example.com/mytest/"> 
    ...
</root>
``````

Add a node with a namespace prefix

```php
\ByJG\Util\XmlUtil::createChild($xml->documentElement, 'my:othernodens', 'teste');
```

Add a node with a namespace

```php
\ByJG\Util\XmlUtil::createChild($xml->documentElement, 'nodens', 'teste', 'http://www.example.com/mytest/');
```

## Bonus - CleanDocument

XmlUtil have a class for selectively remove specific marks (tags) 
from the document or remove all marks.

Example:

```php
<?php

$document = new \ByJG\Util\CleanDocument($documentXmlOrHtml);

$document
    ->removeContentByTag('a', 'name')
    ->removeContentByProperty('src')
    ->stripTagsExcept(['img'])
    ->get();

```

## Install

Just type: `composer require "byjg/xmlutil=1.0.*"`

