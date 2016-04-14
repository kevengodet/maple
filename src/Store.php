<?php

namespace Maple;

interface Store
{
//    public function initialize(array $options);
//    public function load($key, array $options = []);

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
    public function fetch($key, $default = null, array $options = []);

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
    public function store($key, $value, array $options = []);

    /**
     * Delete the key from the store and return the current value.
     *
     * @param string $key
     * @param array $options
     *
     * @return mixed
     */
    public function delete($key, array $options = []);

    /**
     * TRUE if the key exists, FALSE if it does not.
     *
     * @param string $key
     * @param array $options
     *
     * @return boolean
     */
    public function has($key, array $options = []);

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
    public function incr($key, $amount = 1, array $options = []);

    /**
     * Does the store support the given feature?
     *
     * @param string $feature
     *
     * @return boolean
     */
    public function supports($feature);

    /**
     * Atomic creation
     *
     * @param type $key
     * @param type $value
     * @param array $options
     *
     * @return boolean TRUE if the key is created, FALSE if is already exists
     */
//    public function create($key, $value, array $options = []);
//    public function clear(array $options = []);
//    public function close();
//    public function features();
//    public function supports($feature);
}
