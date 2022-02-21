<?php

namespace App\Provider;

use App\Object\Collection\TransactionResourceCollection;
use App\Object\Resource\TransactionResource;
use App\Repository\TransactionRepository;

class TransactionProviderDatabase extends TransactionProvider
{
    /**
     * @var TransactionRepository
     */
    private $transactionRepository;

    /**
     * @param TransactionRepository $transactionRepository
     */
    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * @return TransactionResourceCollection
     */
    public function getAll(): TransactionResourceCollection
    {
        $data = $this->transactionRepository->findAll();

        return $this->createTransactionCollectionFromArray($data);
    }

    /**
     * @param array $data
     *
     * @return TransactionResourceCollection
     */
    private function createTransactionCollectionFromArray(array $data): TransactionResourceCollection
    {
        $collection = new TransactionResourceCollection();

        foreach ($data as $transaction) {
            $collection->add(TransactionResource::createFromTransaction($transaction));
        }

        return $collection;
    }
}
