<?php

namespace App\Provider;

use App\Object\Collection\TransactionResourceCollection;

abstract class TransactionProvider
{
    /**
     * Retrieve all the transactions.
     *
     * @return TransactionResourceCollection
     */
    public abstract function getAll(): TransactionResourceCollection;
}
