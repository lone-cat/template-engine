<?php

namespace LoneCat\TemplateEngine;

use Closure;

class Template
{
    private $parent_template_name;
    private Closure $render_function;

    public function __construct(Closure $render, BlockCollection $block, string $filename, array $parameters = [])
    {
        $this->render_function = $render;
        $template = $this;
        extract($parameters, EXTR_SKIP);
        unset($parameters);
        require $filename;
    }

    public function getParentTemplateName() {
        return $this->parent_template_name ?? null;
    }

    public function extend(string $parent_template_name) {
        $this->parent_template_name = $parent_template_name;
    }

    public function render(string $template_name, array $parameters = [])
    {
        $func = $this->render_function;
        return $func($template_name, $parameters);
    }

}