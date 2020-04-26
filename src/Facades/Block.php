<?php

use LoneCat\TemplateEngine\BlockCollection;

Block::init();

abstract class Block
{
    protected static BlockCollection $block_collection;

    public static function init() {
        if (!isset(self::$block_collection)) {
            self::$block_collection = new BlockCollection();
        }
    }

    public static function start(string $name) {
        self::$block_collection->start($name);
    }

    public static function end() {
        self::$block_collection->end();
    }

    public static function get(string $name) {
        return self::$block_collection->get($name);
    }
}