<?php

namespace LoneCat\TemplateEngine;

use Closure;
use Throwable;

class Renderer
{

    private string $path;
    private BlockCollection $block_collection;
    private Closure $render_function;

    public function __construct(string $root_path = 'templates')
    {
        $this->path = realpath($root_path);
        $this->block_collection = new BlockCollection();
        $renderer = $this;
        $this->render_function = function (string $filename, array $parameters) use ($renderer) {
            $renderer->render($filename, $parameters);
        };
    }

    public function render(string $templateName, array $params = []): string
    {
        try {
            do {
                $templateFile = $this->path . '/' . $templateName . '.phtml';
                ob_start();
                $template = new Template($this->render_function, $this->block_collection, $templateFile, $params);
                $content = ob_get_clean();
            } while ($templateName = $template->getParentTemplatename());
        } catch (Throwable $e) {
            while (ob_get_level() > 0) {
                ob_end_clean();
            }
            throw $e;
        }

        return $content;
    }


}