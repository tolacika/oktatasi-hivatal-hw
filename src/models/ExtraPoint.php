<?php

namespace Tolacika\OktatasiHivatalHw\models;

class ExtraPoint
{
    private string $category;
    private string $type;
    private string $lang;

    /**
     * @param string $category
     * @param string $type
     * @param string $lang
     */
    public function __construct(string $category, string $type, string $lang)
    {
        $this->category = $category;
        $this->type = $type;
        $this->lang = $lang;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getLang(): string
    {
        return $this->lang;
    }

    /**
     * @param string $lang
     */
    public function setLang(string $lang): void
    {
        $this->lang = $lang;
    }


}
