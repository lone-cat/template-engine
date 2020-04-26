<?php

namespace Tests\TemplateEngine;

use LoneCat\TemplateEngine\Renderer;
use PHPUnit\Framework\TestCase;

class RendererTest extends TestCase
{

    public function testSimple(): void
    {
        $renderer = new Renderer('tests/TestTemplates');
        $contents = file_get_contents(__DIR__ . '/../TestTemplates/Simple.phtml');
        self::assertTrue($contents === $renderer->render('Simple'));
    }

    public function testExtendWithVars(): void
    {
        $renderer = new Renderer('tests/TestTemplates');
        $var = 'TestVar';
        $vars = ['var' => $var];
        \var_dump($renderer->render('ChildTemplate', $vars));
        self::assertTrue('ab' . $var . $var === $renderer->render('ChildTemplate', $vars));
    }

}