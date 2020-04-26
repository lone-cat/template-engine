<?php

require __DIR__ . '/../vendor/autoload.php';

$renderer = new \LoneCat\TemplateEngine\Renderer(__DIR__ . '/../templates');
echo $renderer->render('main');