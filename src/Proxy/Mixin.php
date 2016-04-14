<?php

namespace Maple\Proxy;

use Maple\Maple;
use Maple\Store;

final class Mixin extends AbstractProxy
{
    /**
     *
     * @var callable[]
     */
    private $mixins;

    /**
     *
     * @param Store $store
     * @param callable[] $mixins
     */
    public function __construct(Store $store, array $mixins = [])
    {
        $this->store = $store;
        $this->mixins = $mixins;
    }

    /**
     *
     * @param type $feature
     *
     * @return boolean
     */
    public function supports($feature)
    {
        return isset($this->mixins[$feature]) or
               $this->store->supports($feature);
    }

    /**
     *
     * @param string $name
     * @param array $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if (isset($this->mixins[$name])) {
            array_unshift($arguments, $this);

            return call_user_func_array($this->mixins[$name], $arguments);
        }

        try {
            $args = [$this, $arguments[0]];
            return Maple::create($name, $args);
        } catch (\Exception $e) {

        }

        return call_user_func_array([$this->store, $name], $arguments);
    }
}
