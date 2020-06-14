<?php

namespace LoneCat\TemplateEngine;

class VarsObject
{

    protected array $parameters;

    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    public function get(string $name, $default = null) {
        return $this->parameters[$name] ?? $default;
    }

    public function __get(string $name)
    {
        return $this->get($name);
    }

    public function __set($name, $value)
    {

    }

    public function html(string $name, $default = null) {
        return htmlentities($this->get($name, $default));
    }

    public function input(string $name, $default = null) {
        return htmlentities($this->get($name, $default));
    }

}