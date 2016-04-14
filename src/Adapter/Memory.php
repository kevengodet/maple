<?php

namespace Maple\Adapter;

use Maple\Store;

final class Memory implements Store
{
    /**
     *
     * @var array
     */
    private $items = [];

    /**
     * Retrieve the value for the given key.
     *
     * If the key is not available, return the default value, or execute the
     * default if it is callable.
     *
     * @param string $key
     * @param mixed $default
     * @param array $options
     *
     * @return mixed
     */
    public function fetch($key, $default = null, array $options = [])
    {
        if (!array_key_exists($key, $this->items)) {
            if (is_callable($default)) {
                return $default();
            }

            return $default;
        }

        return $this->items[$key];
    }

    /**
     * Set a value for a key.
     *
     * If the key is already used, overwrite it.
     *
     * @param string $key
     * @param mixed $value
     * @param array $options
     *
     * @return void
     */
    public function store($key, $value, array $options = [])
    {
        $this->items[$key] = $value;
    }

    /**
     * Delete the key from the store and return the current value.
     *
     * @param string $key
     * @param array $options
     *
     * @return mixed
     */
    public function delete($key, array $options = [])
    {
        if (!array_key_exists($key, $this->items)) {
            return null;
        }

        $value = $this->items[$key];
        unset($this->items[$key]);

        return $value;
    }

    /**
     * TRUE if the key exists, FALSE if it does not.
     *
     * @param string $key
     * @param array $options
     *
     * @return boolean
     */
    public function has($key, array $options = [])
    {
        return array_key_exists($key, $this->items);
    }

    /**
     * Increment numeric value.
     *
     * If the key does not exists, it is created and initialized to 0.
     *
     * This is an atomic operation which is not supported by all stores.
     * Returns value after operation.
     *
     * If you increment a non integer value an exception will be raised.
     *
     * @param string $key
     * @param int $amount
     * @param array $options
     *
     * @return int
     */
    public function incr($key, $amount = 1, array $options = [])
    {
        if (!$this->has($key, $options)) {
            $this->items[$key] = 0;
        }

        return $this->items[$key] += $amount;
    }

    public function supports($feature)
    {
        return false;
    }
}
