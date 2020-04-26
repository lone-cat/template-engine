<?php

namespace LoneCat\TemplateEngine;

use Throwable;

class Renderer
{

    protected string $path;

    public function __construct(string $root_path = 'templates')
    {
        $this->path = realpath($root_path);
        require_once __DIR__ . '/Facades/Block.php';
        require_once __DIR__ . '/Facades/Template.php';
        require_once __DIR__ . '/Functions/Functions.php';
        $this->block_collection = new BlockCollection();
    }

    public function render(string $templateName, array $params = []): string
    {
        \Template::setRenderer($this);
        try {
            do {
                $templateFile = $this->path . '/' . $templateName . '.phtml';
                ob_start();
                $template = new TemplateObject($templateFile, $params);
                \Template::getContent($template);
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