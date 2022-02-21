<?php

namespace App\Object\Collection;

use App\Entity\Transaction;

class TransactionCollection extends Collection
{
    /**
     * @var Transaction[]
     */
    protected $items = [];

    /**
     * @param Transaction $transaction
     */
    public function add(Transaction $transaction)
    {
        $this->items[] = $transaction;
    }

    /**
     * @return Transaction[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
