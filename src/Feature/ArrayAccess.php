<?php

namespace Maple\Capability;

use Maple\Adapter\Decorator;

final class ArrayAccess extends Decorator implements \ArrayAccess
{
    /**
     *
     * @param Store $store
     */
    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    /**
     * Whether an offset exists
     * @param mixed $offset  An offset to check for.
     *
     * @return boolean TRUE on success or FALSE on failure.
     *
     * The return value will be casted to boolean if non-boolean was returned.
     */
    public function offsetExists ($offset)
    {
        return $this->has($offset);
    }

    /**
     * Offset to retrieve
     *
     * @param mixed $offset The offset to retrieve.
     *
     * @return mixed Can return all value types.
     */
    public function offsetGet ($offset)
    {
        return $this->fetch($offset);
    }

    /**
     * Assign a value to the specified offset
     *
     * @param mixed $offset The offset to assign the value to.
     *
     * @param mixed $value  The value to set.
     *
     * @return void No value is returned.
     */
    public function offsetSet ($offset, $value)
    {
        $this->store($offset, $value);
    }

    /**
     * Unset an offset
     *
     * @param mixed $offset The offset to unset.
     *
     * @return void No value is returned.
     */
    public function offsetUnset ($offset)
    {
        $this->delete($key);
    }
}
