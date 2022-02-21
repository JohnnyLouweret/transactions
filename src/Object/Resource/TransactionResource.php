<?php

namespace App\Object\Resource;

use App\Entity\Transaction;
use DateTime;

class TransactionResource
{
    /**
     * Fields.
     */
    const FIELD_ID = 'id';
    const FIELD_CODE = 'code';
    const FIELD_AMOUNT = 'amount';
    const FIELD_USER = 'user_id';
    const FIELD_CREATED_AT = 'created_at';
    const FIELD_UPDATED_AT = 'updated_at';

    const DATE_FORMAT = 'd-m-y';

    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $code;

    /**
     * @var string
     */
    public $amount;

    /**
     * @var string
     */
    public $user;

    /**
     * @var DateTime
     */
    public $createdAt;

    /**
     * @var DateTime
     */
    public $updatedAt;

    /**
     * @param Transaction $transaction
     *
     * @return TransactionResource
     */
    public static function createFromTransaction(Transaction $transaction): TransactionResource
    {
        $transactionResource = new self();

        $transactionResource->id = $transaction->getId();
        $transactionResource->code = $transaction->getCode();
        $transactionResource->amount = $transaction->getAmount();
        $transactionResource->user = $transaction->getUser()->getId();
        $transactionResource->createdAt = $transaction->getCreatedAt();
        $transactionResource->updatedAt = $transaction->getUpdatedAt();

        return $transactionResource;
    }

    /**
     * @param array $transactions
     *
     * @return TransactionResource
     */
    public static function createFromArray(array $transactions): TransactionResource
    {
        $transactionResource = new self();

        if (array_key_exists(self::FIELD_ID, $transactions)) {
            $transactionResource->id = $transactions[self::FIELD_ID];
        }
        if (array_key_exists(self::FIELD_CODE, $transactions)) {
            $transactionResource->code = $transactions[self::FIELD_CODE];
        }
        if (array_key_exists(self::FIELD_AMOUNT, $transactions)) {
            $transactionResource->amount = $transactions[self::FIELD_AMOUNT];
        }
        if (array_key_exists(self::FIELD_USER, $transactions)) {
            $transactionResource->user = $transactions[self::FIELD_USER];
        }
        if (array_key_exists(self::FIELD_CREATED_AT, $transactions)) {
            $transactionResource->createdAt = $transactions[self::FIELD_CREATED_AT];
        }
        if (array_key_exists(self::FIELD_UPDATED_AT, $transactions)) {
            $transactionResource->createdAt = $transactions[self::FIELD_UPDATED_AT];
        }

        return $transactionResource;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            self::FIELD_ID => $this->id,
            self::FIELD_CODE => $this->code,
            self::FIELD_AMOUNT => $this->amount,
            self::FIELD_USER => $this->user,
            self::FIELD_CREATED_AT => $this->createdAt,
            self::FIELD_UPDATED_AT => $this->updatedAt
        ];
    }
}
