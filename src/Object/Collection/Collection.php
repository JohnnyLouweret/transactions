<?php

namespace App\Object\Collection;

abstract class Collection
{
    /**
     * @var array
     */
    protected $items = [];

    /**
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * @return bool
     */
    public function isNotEmpty(): bool
    {
        return false === $this->isEmpty();
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        if (count($this->items) === 0) {
            return true;
        }

        return false;
    }
}
