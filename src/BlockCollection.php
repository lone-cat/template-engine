<?php

namespace LoneCat\TemplateEngine;

class BlockCollection
{
    protected array $collection = [];
    protected array $block_names = [];

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

        if (!isset($this->collection[$block_name])) {
            $this->collection[$block_name] = ob_get_contents();
        }

        ob_end_clean();

        if (count($this->block_names) > 0) {
            echo $this->collection[$block_name];
        }
    }

}