<?php

namespace App;

use Exception;
use Symfony\Component\Serializer\SerializerInterface;

class CsvParser
{
    /**
     * Path
     */
    const PATH_TRANSACTION = '/transactions.csv';

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function decodeAndReadTransactions(): array
    {
        $data = $this->serializer->decode(
            file_get_contents(dirname(__DIR__) . self::PATH_TRANSACTION),
            'csv'
        );

        if (false === is_array($data)) {
            throw new Exception('Unable to read transactions');
        }

        return $data;
    }
}
