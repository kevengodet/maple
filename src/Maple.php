<?php

namespace Maple;

/**
 *
 */
final class Maple
{
    /**
     *
     * @var callable[]
     */
    static private $mixins = [];

    /**
     *
     * @param string $adapter
     * @param array $options
     *
     * @return Store
     */
    static public function create($adapter = 'memory', array $options = [])
    {
        if (false === $class = self::getAdapterClass($adapter)) {
            throw new \InvalidArgumentException("Maple adapter '$adapter' not found.");
        }

        $r = new \ReflectionClass($class);
        $store = $r->newInstanceArgs($options);

        if ($store->supports('mixin')) {
            return $store;
        }

        return new Mixin($store);
    }

    /**
     *
     * @param string $adapter
     *
     * @return string|FALSE
     */
    static public function getAdapterClass($adapter)
    {
        foreach ([
                'Maple\\Adapter\\'.ucfirst($adapter),
                'Maple\\Proxy\\'.ucfirst($adapter)
            ] as $class) {
            if (class_exists($class)) {
                return $class;
            }
        }

        return false;
    }

    /**
     *
     * @param string $method
     * @param callable $callback
     */
    static public function mixin($method, $callback)
    {
        self::$mixins[$method] = $callback;
    }
}
