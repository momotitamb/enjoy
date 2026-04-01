<?php

class Container {
    private $bindings = [];

    public function bind(string $abstract, callable $factory) {
        $this->bindings[$abstract] = $factory;
    }

    public function make(string $abstract) {
        if (isset($this->bindings[$abstract])) {
            return ($this->bindings[$abstract])($this);
        }
        return new $abstract();
    }
}