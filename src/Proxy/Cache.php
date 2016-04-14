<?php

namespace Maple\Proxy;

use Maple\Store;
use Maple\Exception\CacheMissException;

/**
 * @see https://msdn.microsoft.com/en-us/library/dn589799.aspx
 */
final class Cache extends AbstractProxy
{
    /**
     *
     * @var callable
     */
    private $provider;

    /**
     *
     * @param Store $store
     * @param callable $provider
     */
    public function __construct(Store $store, callable $provider)
    {
        $this->store = $store;
        $this->provider = $provider;
    }

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
        if ($this->store->has($key, $options)) {
            return $this->cache->fetch($key, $default, $options);
        }

        try {
            $this->store->store($key, call_user_func($this->provider, $key), $options);
        } catch (CacheMissException $e) {
            return $default;
        }

        return $this->store->fetch($key, $default, $options);
    }
}
