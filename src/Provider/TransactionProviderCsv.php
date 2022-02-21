<?php

namespace App\Provider;

use App\CsvParser;
use App\Object\Collection\TransactionResourceCollection;
use App\Object\Resource\TransactionResource;
use Exception;

class TransactionProviderCsv extends TransactionProvider
{
    /**
     * @var CsvParser
     */
    private $csvParser;

    /**
     * @param CsvParser $csvParser
     */
    public function __construct(CsvParser $csvParser)
    {
        $this->csvParser = $csvParser;
    }

    /**
     * @return TransactionResourceCollection
     * @throws Exception
     */
    public function getAll(): TransactionResourceCollection
    {
        $data = $this->csvParser->decodeAndReadTransactions();

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
            $collection->add(TransactionResource::createFromArray($transaction));
        }

        return $collection;
    }
}
