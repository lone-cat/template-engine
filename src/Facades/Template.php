<?php

use LoneCat\TemplateEngine\Renderer;
use LoneCat\TemplateEngine\TemplateObject;

abstract class Template
{

    protected static Renderer $renderer;
    protected static array $template_queue = [];

    public static function setRenderer(Renderer $renderer) {
        self::$renderer = $renderer;
    }

    public static function extend(string $template_name) {
        self::$template_queue[key(self::$template_queue)]->setParentTemplateName($template_name);
    }

    public static function render(string $template_nmae, array $params = []): string {
        return self::$renderer->render($template_nmae, $params);
    }

    public static function getContent(TemplateObject $template) {
        self::$template_queue[] = $template;
        end(self::$template_queue);
        extract($template->getParameters());
        $filemame = $template->getFileName();
        unset($template);
        include $filemame;
        array_pop(self::$template_queue);
    }

}