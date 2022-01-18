<?php

namespace TheBachtiarz\Toolkit\Helper\App\Converter;

use Illuminate\Support\Str;
use TheBachtiarz\Toolkit\Helper\App\Interfaces\ConverterInterface;

trait ConverterHelper
{
    /**
     * convert to rupiah format currency
     *
     * @param string|null $balance
     * @param boolean $decimal
     * @return string
     */
    private static function setRupiah(?string $balance, bool $decimal = false): string
    {
        $_balance = $balance ?? '0';

        return ConverterInterface::CONVERTER_RUPIAH_CODE_FORMAT . " " . number_format($_balance, ($decimal ? 2 : 0), ",", ".");
    }

    /**
     * convert underscored log type name,
     * into human readable
     *
     * @param string $logType
     * @return string
     */
    private static function humanLogTypeName(string $logType): string
    {
        $replace = Str::of($logType)->replace('_', ' ');

        return ucwords($replace);
    }
}
