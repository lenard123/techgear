<?php

require "vendor/autoload.php";

$xml = \ByJG\Util\XmlUtil::createXmlDocumentFromStr('<root />');

$myNode = \ByJG\Util\XmlUtil::createChild($xml->documentElement, 'mynode');
\ByJG\Util\XmlUtil::createChild($myNode, 'subnode', 'text');
\ByJG\Util\XmlUtil::createChild($myNode, 'subnode', 'more text');
$otherNode = \ByJG\Util\XmlUtil::createChild($myNode, 'othersubnode', 'other text');
\ByJG\Util\XmlUtil::addAttribute($otherNode, 'attr', 'value');

echo $xml->saveXML();

print_r(\ByJG\Util\XmlUtil::xml2Array($xml));


$node = \ByJG\Util\XmlUtil::selectSingleNode($xml, '//subnode');
echo $node->nodeValue . "\n";
$node = \ByJG\Util\XmlUtil::selectSingleNode($myNode, '//subnode');
echo $node->nodeValue . "\n";


$nodeList = \ByJG\Util\XmlUtil::selectNodes($xml, '//subnode');
foreach ($nodeList as $node)
{
    echo $node->nodeName;
}
echo "\n";

$nodeList = \ByJG\Util\XmlUtil::selectNodes($myNode, '//subnode');
foreach ($nodeList as $node)
{
    echo $node->nodeName;
}
echo "\n";


\ByJG\Util\XmlUtil::addNamespaceToDocument($xml, 'my', 'http://www.example.com/mytest/');
echo $xml->saveXML() . "\n";

\ByJG\Util\XmlUtil::createChild($xml->documentElement, 'nodens', 'teste', 'http://www.example.com/mytest/');
\ByJG\Util\XmlUtil::createChild($xml->documentElement, 'my:othernodens', 'teste');
echo $xml->saveXML() . "\n";

$nodeList = \ByJG\Util\XmlUtil::selectNodes($xml, '//my:othernodens', [ 'my' => 'http://www.example.com/mytest/' ] );
foreach ($nodeList as $node)
{
    echo 'A' . $node->nodeName;
}


//$str = '<?xml version="1.0" encoding="utf-8"'
//    . '<root xmlns:my="http://www.example.com/mytest/">'
//    . '    '
//    . '</root>';
