<?php

namespace Maple;

interface Transformer
{
    /**
     *
     * @param mixed $value
     *
     * @return string
     */
    public function encode($value);

    /**
     *
     * @param string $value
     *
     * @return mixed
     */
    public function decode($value);
}
