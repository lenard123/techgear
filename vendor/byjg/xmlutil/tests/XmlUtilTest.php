<?php

namespace Tests;

use ByJG\Util\XmlUtil;
use PHPUnit\Framework\TestCase;

class XmlUtilTest extends TestCase
{

    const XMLHEADER = '<?xml version="1.0" encoding="utf-8"?>';

    /**
     * @var \ByJG\Util\XmlUtil
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {

    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    public function testCreateXmlDocument()
    {
        $xml = XmlUtil::createXmlDocument();
        $this->assertEquals(self::XMLHEADER . "\n", $xml->saveXml());
    }

    public function testCreateXmlDocumentFromFile()
    {
        $xml = XmlUtil::createXmlDocumentFromFile(__DIR__ . '/buggy.xml', XMLUTIL_OPT_DONT_PRESERVE_WHITESPACE);
        $this->assertEquals(self::XMLHEADER . "\n<root><node><subnode>value</subnode></node></root>\n", $xml->saveXML());
    }

    public function testCreateXmlDocumentFromStr()
    {
        $xmlStr = '<root/>';
        $xml = XmlUtil::createXmlDocumentFromStr($xmlStr);
        $this->assertEquals(self::XMLHEADER . "\n<root/>\n", $xml->saveXML());
    }

    public function testCreateDocumentFromNode()
    {
        $xml = XmlUtil::createXmlDocumentFromFile(__DIR__ . '/buggy.xml');
        $node = XmlUtil::selectSingleNode($xml, '//subnode');


        $xmlFinal = XmlUtil::createDocumentFromNode($node);
        $this->assertEquals(self::XMLHEADER . "\n<subnode>value</subnode>\n", $xmlFinal->saveXML());
    }

    public function testFixXmlHeader1()
    {
        $xml = '<root/>';
        $result = XmlUtil::fixXmlHeader($xml);
        $this->assertEquals(self::XMLHEADER . '<root/>', $result);
    }

    public function testFixXmlHeader2()
    {
        $xml = '<?xml?><root/>';
        $result = XmlUtil::fixXmlHeader($xml);
        $this->assertEquals(self::XMLHEADER . '<root/>', $result);
    }

    public function testFixXmlHeader3()
    {
        $xml = '<?xml version="1.0"?><root/>';
        $result = XmlUtil::fixXmlHeader($xml);
        $this->assertEquals(self::XMLHEADER . '<root/>', $result);
    }

    public function testFixXmlHeader4()
    {
        $xml = '<?xml encoding="utf8"?><root/>';
        $result = XmlUtil::fixXmlHeader($xml);
        $this->assertEquals(self::XMLHEADER . '<root/>', $result);
    }

    public function testFixXmlHeader5()
    {
        $xml = '<?xml encoding="ascii"?><root/>';
        $result = XmlUtil::fixXmlHeader($xml);
        $this->assertEquals(self::XMLHEADER . '<root/>', $result);
    }

    public function testSaveXmlDocument()
    {
        $filename = sys_get_temp_dir() . '/save.xml';
        $xml = XmlUtil::createXmlDocumentFromFile(__DIR__ . '/buggy.xml', XMLUTIL_OPT_DONT_PRESERVE_WHITESPACE);

        if (file_exists($filename)) {
            unlink($filename);
        }
        $this->assertFalse(file_exists($filename));

        XmlUtil::saveXmlDocument($xml, $filename);
        $this->assertTrue(file_exists($filename));

        $contents = file_get_contents($filename);
        $this->assertEquals(self::XMLHEADER . "\n<root><node><subnode>value</subnode></node></root>\n", $contents);

        unlink($filename);
    }

    public function testGetFormattedDocument()
    {
        $xml = XmlUtil::createXmlDocumentFromFile(__DIR__ . '/buggy.xml');
        $xml->preserveWhiteSpace = true;
        $xml->formatOutput = false;
        $formatted = XmlUtil::getFormattedDocument($xml);

        $this->assertTrue($xml->preserveWhiteSpace);
        $this->assertFalse($xml->formatOutput);
        $this->assertEquals(
            self::XMLHEADER . "\n<root>\n    <node>\n        <subnode>value</subnode>\n    </node>\n</root>\n" , $formatted
        );
    }

    public function testAddNamespaceToDocument()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testAddNodeFromFile()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testAddNodeFromNode()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testCreateChild()
    {
        $dom = XmlUtil::createXmlDocumentFromStr('<root/>');
        $node = XmlUtil::createChild($dom->documentElement, 'test1');
        XmlUtil::createChild($node, 'test2', 'text2');
        $node2 = XmlUtil::createChild($node, 'test3', 'text3', 'http://opensource.byjg.com');

        $this->assertEquals(
            self::XMLHEADER . "\n" .
            '<root>'
            . '<test1>'
            .   '<test2>text2</test2>'
            .   '<test3 xmlns="http://opensource.byjg.com">text3</test3>'
            . '</test1>'
            . '</root>'
            . "\n",
            $dom->saveXML()
        );

        XmlUtil::createChildBeforeNode('test1_2', 'text1-2', $node2);

        $this->assertEquals(
            self::XMLHEADER . "\n" .
            '<root>'
            . '<test1>'
            .   '<test2>text2</test2>'
            .   '<test1_2>text1-2</test1_2>'
            .   '<test3 xmlns="http://opensource.byjg.com">text3</test3>'
            . '</test1>'
            . '</root>'
            . "\n",
            $dom->saveXML()
        );

        XmlUtil::createChildBefore($node, 'testBefore', 'textBefore');

        $this->assertEquals(
            self::XMLHEADER . "\n" .
            '<root>'
            . '<test1>'
            .   '<testBefore>textBefore</testBefore>'
            .   '<test2>text2</test2>'
            .   '<test1_2>text1-2</test1_2>'
            .   '<test3 xmlns="http://opensource.byjg.com">text3</test3>'
            . '</test1>'
            . '</root>'
            . "\n",
            $dom->saveXML()
        );
    }

    public function testAddTextNode()
    {
        $dom = XmlUtil::createXmlDocumentFromStr('<root><subject></subject></root>');

        $node = XmlUtil::selectSingleNode($dom->documentElement, 'subject');
        XmlUtil::addTextNode($node, 'Text');

        $this->assertEquals(
            self::XMLHEADER . "\n" .
            '<root>'
            . '<subject>'
            .   'Text'
            . '</subject>'
            . '</root>'
            . "\n",
            $dom->saveXML()
        );
    }

    public function testAddAttribute()
    {
        $dom = XmlUtil::createXmlDocumentFromStr('<root><subject>Text</subject></root>');

        $node = XmlUtil::selectSingleNode($dom->documentElement, 'subject');
        XmlUtil::addAttribute($node, 'attr', 'value');

        $this->assertEquals(
            self::XMLHEADER . "\n" .
            '<root>'
            . '<subject attr="value">'
            .   'Text'
            . '</subject>'
            . '</root>'
            . "\n",
            $dom->saveXML()
        );
    }

    public function testSelectNodes()
    {
        $dom = XmlUtil::createXmlDocumentFromStr('<root><a><item arg="1"/><item arg="2"><b1/><b2/></item><item arg="3"/></a></root>');

        $nodeList = XmlUtil::selectNodes($dom->documentElement, 'a/item');
        $this->assertEquals(3, $nodeList->length);
        $this->assertEquals('item', $nodeList->item(0)->nodeName);
        $this->assertEquals('1', $nodeList->item(0)->attributes->getNamedItem('arg')->nodeValue);
        $this->assertEquals('item', $nodeList->item(1)->nodeName);
        $this->assertEquals('2', $nodeList->item(1)->attributes->getNamedItem('arg')->nodeValue);
        $this->assertEquals('item', $nodeList->item(2)->nodeName);
        $this->assertEquals('3', $nodeList->item(2)->attributes->getNamedItem('arg')->nodeValue);

        $node = XmlUtil::selectSingleNode($nodeList->item(1), 'b2');
        $this->assertEquals('b2', $node->nodeName);
    }

    public function testRegisterNamespaceForFilter()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testInnerText()
    {
        $dom = XmlUtil::createXmlDocumentFromStr('<root><a><item arg="1"/><item arg="2"><b1/><b2/></item><item arg="3"/></a></root>');

        $node = XmlUtil::selectSingleNode($dom->documentElement, 'a/item[@arg="2"]');

        $text = XmlUtil::innerText($node);
        $this->assertEquals("\n<b1/><b2/>\n", $text);
    }

    public function testInnerXML()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testCopyChildNodesFromNodeToString()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testSaveXmlNodeToString()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testBr2nl()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testShowXml()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testRemoveNode()
    {
        $dom = XmlUtil::createXmlDocumentFromStr('<root><subject>Text</subject><a/><b/></root>');

        $node = XmlUtil::selectSingleNode($dom->documentElement, 'subject');
        XmlUtil::removeNode($node);

        $this->assertEquals(
            self::XMLHEADER . "\n" .
            '<root>'
            . '<a/>'
            . '<b/>'
            . '</root>'
            . "\n",
            $dom->saveXML()
        );

    }

    public function testRemoveTagName()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    public function testXml2Array1()
    {
        $xml = XmlUtil::createXmlDocumentFromFile(__DIR__ . '/buggy.xml');

        $array = XmlUtil::xml2Array($xml);
        $this->assertEquals([ "node" => [ "subnode" => "value"]], $array);
    }

    public function testXml2Array2()
    {
        $xml = XmlUtil::createXmlDocumentFromStr('<root><node param="pval">value</node></root>');

        $array = XmlUtil::xml2Array($xml);
        $this->assertEquals([ "node" => "value"], $array);
    }

    public function testSelectNodesNamespace()
    {
        $document = XmlUtil::createXmlDocumentFromFile(__DIR__ . '/feed-atom.txt');

        $nodes = XmlUtil::selectNodes(
            $document->documentElement,
            'ns:entry',
            [
                "ns" => "http://www.w3.org/2005/Atom"
            ]
        );

        $this->assertEquals(25, $nodes->length);
    }
}
