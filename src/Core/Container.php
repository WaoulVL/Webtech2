<?php

// src/Core/Container.php

namespace Core;

use InvalidArgumentException;
use Closure;

class Container
{
    protected array $bindings = [];

    public function bind(string $name, $concrete): void
    {
        if (!($concrete instanceof Closure) && !is_string($concrete)) {
            throw new InvalidArgumentException('The $concrete parameter must be a string or a Closure.');
        }

        $this->bindings[$name] = $concrete;
    }

    public function make(string $name)
    {
        return $this->get($name);
    }

    public function get(string $id)
    {
        if (!$this->has($id)) {
            throw new InvalidArgumentException("No binding found for the given ID: {$id}");
        }

        $concrete = $this->bindings[$id];

        if ($concrete instanceof Closure) {
            return $concrete($this);
        }

        return new $concrete;
    }

    public function has(string $id): bool
    {
        return isset($this->bindings[$id]);
    }
}
