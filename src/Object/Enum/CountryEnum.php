<?php

namespace App\Object\Enum;

class CountryEnum extends Enum
{
    /**
     * Options
     */
    const COUNTRY_AUSTRIA = 'Austria';

    /**
     * ISO2
     */
    const COUNTRY_AUSTRIA_ISO_2 = 'AT';

    /**
     * ISO3
     */
    const COUNTRY_AUSTRIA_ISO_3 = 'AUT';

    /**
     * @var string[]
     */
    protected static $options = [
        self::COUNTRY_AUSTRIA
    ];

    /**
     * @var string[]
     */
    protected static $iso2Codes = [
        self::COUNTRY_AUSTRIA => self::COUNTRY_AUSTRIA_ISO_2
    ];

    /**
     * @return string
     */
    public function getSelfIso2Code(): string
    {
        return static::$iso2Codes[$this->value];
    }

    /**
     * @return CountryEnum
     */
    public static function createAustria(): CountryEnum
    {
        return new self(self::COUNTRY_AUSTRIA);
    }
}
