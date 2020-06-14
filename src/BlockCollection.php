<?php

namespace LoneCat\TemplateEngine;

class BlockCollection
{
    protected array $collection = [];
    protected array $block_names = [];

    private function add(string $block_name, string $block_content) {
        $this->collection[$block_name] = $block_content;
    }

    public function get(string $block_name) {
        return $this->collection[$block_name];
    }

    public function start(string $block_name) {
        ob_start();
        $this->block_names[] = $block_name;
    }

    public function startOver(string $block_name)
    {
        unset($this->collection[$block_name]);
        if (in_array($block_name, $this->block_names, true)) {
            throw new \Exception('Unfinished block cant be overwritten');
        }
        $this->start($block_name);
    }

    public function end() {
        $block_name = array_pop($this->block_names);
        $this->collection[$block_name] = ob_get_clean();
        if (count($this->block_names) > 0) {
            echo $this->collection[$block_name];
        }
    }

}