<?php

namespace LoneCat\TemplateEngine;

use Closure;

class Template
{
    protected $parent_template_name;
    protected Closure $render_function;

    public function __construct(Closure $render_function, BlockCollection $block, string $filename, array $parameters = [])
    {
        $this->render_function = $render_function;
        unset($render_function);
        $template = $this;
        $vars = new VarsObject($parameters);
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