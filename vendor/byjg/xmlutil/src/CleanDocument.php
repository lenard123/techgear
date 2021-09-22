<?php

namespace ByJG\Util;

class CleanDocument
{
    protected $document;

    public function __construct($document)
    {
        $this->document = $document;
    }

    public function stripAllTags()
    {
        return strip_tags($this->document);
    }

    /**
     * @param array $allowedTags
     * @return $this
     */
    public function stripTagsExcept(array $allowedTags)
    {
        $this->document = strip_tags($this->document, '<' . implode('><', $allowedTags) . '>');
        return $this;
    }

    /**
     * @param $property
     * @return $this
     */
    public function removeContentByProperty($property)
    {
        $this->removeContentByTag('\w', $property);
        return $this;
    }

    /**
     * @param $tag
     * @param string $property
     * @return $this
     */
    public function removeContentByTag($tag, $property = '')
    {
        $pattern = '~<(' . $tag . ')\b\s[^>]*>.*?</\1>~';
        if (!empty($property)) {
            $pattern = '~<(' . $tag . ')\b\s[^>]*' . $property . '\s*?=?[^>]*>.*?</\1>~';
        }
        $this->document = preg_replace($pattern, '', $this->document);
        return $this;
    }

    /**
     * @param $tag
     * @param string $property
     * @return $this
     */
    public function removeContentByTagWithoutProperty($tag, $property)
    {
        $pattern = '~<(' . $tag . ')\b\s(?![^>]*' . $property . '\s*?=?)[^>]*>.*?<\/\1>~';
        $this->document = preg_replace($pattern, '', $this->document);
        return $this;
    }

    public function get()
    {
        return $this->document;
    }
}
