<?php

namespace Maple\Adapter;

use Maple\Store;

abstract class AbstractAdapter implements Store
{
    /**
     *
     * @var array
     */
    protected $mixins = [];

    /**
     *
     * @var array
     */
    protected $features;

    /**
     *
     * @param type $feature
     *
     * @return boolean
     */
    public function supports($feature)
    {
        return isset($this->mixins[$feature]);
    }

    public function features()
    {
        if (!is_null($this->features)) {
            return $this->features;
        }

        if (!isset($this->store)) {
            $this->features = array_keys($mixins);
        }

        return $this->features = array_unique(array_merge($this->mixins, $this->store));
    }
}
