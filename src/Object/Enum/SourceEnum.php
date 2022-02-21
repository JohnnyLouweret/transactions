<?php

namespace App\Object\Enum;

class SourceEnum extends Enum
{
    /**
     * Options
     */
    const SOURCE_DATABASE = 'db';
    const SOURCE_CSV = 'csv';

    /**
     * @var string[]
     */
    protected static $options = [
        self::SOURCE_DATABASE,
        self::SOURCE_CSV
    ];

    /**
     * @return bool
     */
    public function isDatabase(): bool
    {
        return $this->value === self::SOURCE_DATABASE;
    }

    /**
     * @return bool
     */
    public function isCsv(): bool
    {
        return $this->value === self::SOURCE_CSV;
    }
}
