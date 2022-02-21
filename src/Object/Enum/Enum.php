<?php

namespace App\Object\Enum;

use Exception;

abstract class Enum
{
    const EXCEPTION_INVALID_ENUM = '%s is invalid';

    /**
     * @var array
     */
    protected static $options = [];

    /**
     * @var string
     */
    protected $value;

    /**
     * @param string $value
     *
     * @throws Exception
     */
    public function __construct(string $value)
    {
        $this->assertValueIsValid($value);

        $this->value = $value;
    }

    /**
     * @return array<string>
     */
    public static function getOptions(): array
    {
        return static::$options;
    }

    /**
     * @param mixed $input
     *
     * @return bool
     */
    public static function isValidOption($input): bool
    {
        return is_string($input) && in_array($input, static::$options);
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @throws Exception
     */
    private function assertValueIsValid(string $value): void
    {
        if (!self::isValidOption($value)) {
            throw new Exception(sprintf(self::EXCEPTION_INVALID_ENUM, $value));
        }
    }
}
