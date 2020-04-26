<?php

namespace LoneCat\TemplateEngine;

class TemplateObject
{
    protected $parent_template_name;
    protected $filename;
    protected $parameters;

    public function __construct($filename, $parameters)
    {
        $this->filename = $filename;
        $this->parameters = $parameters;
    }

    public function getFileName() {
        return $this->filename;
    }

    public function getParameters() {
        return $this->parameters;
    }

    public function getParentTemplateName() {
        return $this->parent_template_name;
    }

    public function setParentTemplateName(string $parent_template_name) {
        $this->parent_template_name = $parent_template_name;
    }
}