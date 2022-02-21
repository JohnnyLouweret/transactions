<?php

namespace App\Object\Collection;

use App\Object\Resource\TransactionResource;

class TransactionResourceCollection extends Collection
{
    /**
     * @var TransactionResource[]
     */
    protected $items = [];

    /**
     * @param TransactionResource $transaction
     */
    public function add(TransactionResource $transaction)
    {
        $this->items[] = $transaction;
    }

    /**
     * @return TransactionResource[]
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
        $result = [];

        foreach ($this->getItems() as $item) {
            $result['data'][] = $item->toArray();
        }

        return $result;
    }
}
