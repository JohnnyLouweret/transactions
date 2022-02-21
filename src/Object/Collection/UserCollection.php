<?php

namespace App\Object\Collection;

use App\Entity\User;

class UserCollection extends Collection
{
    /**
     * Fields.
     */
    const FIELD_DATA = 'data';

    /**
     * @var User[]
     */
    protected $items = [];

    /**
     * @param User $user
     */
    public function add(User $user)
    {
        $this->items[] = $user;
    }

    /**
     * @return User[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = [];

        foreach ($this->items as $item) {
            $array[self::FIELD_DATA][] = $item->toArray();
        }

        return $array;
    }
}
