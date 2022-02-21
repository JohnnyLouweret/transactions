<?php

namespace App\Entity;

abstract class AbstractEntity
{
    /**
     * @return array
     */
    public function toArray(): array
    {
        return [];
    }
}
