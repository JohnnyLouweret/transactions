<?php

namespace App\Provider;

use App\Object\Enum\SourceEnum;
use Exception;

class TransactionProviderFactory
{
    /**
     * @var TransactionProviderDatabase
     */
    private $transactionProviderDatabase;

    /**
     * @var TransactionProviderCsv
     */
    private $transactionProviderCsv;

    /**
     * @param TransactionProviderDatabase $transactionProviderDatabase
     * @param TransactionProviderCsv      $transactionProviderCsv
     */
    public function __construct(
        TransactionProviderDatabase $transactionProviderDatabase,
        TransactionProviderCsv $transactionProviderCsv
    ) {
        $this->transactionProviderDatabase = $transactionProviderDatabase;
        $this->transactionProviderCsv = $transactionProviderCsv;
    }

    /**
     * @return TransactionProviderCsv
     * @throws Exception
     */
    public function createTransactionProviderFromSource(SourceEnum $source): TransactionProvider
    {
        if ($source->isDatabase()) {
            return $this->transactionProviderDatabase;
        } else if ($source->isCsv()) {
            return $this->transactionProviderCsv;
        }

        throw new Exception('Invalid source provided');
    }
}
