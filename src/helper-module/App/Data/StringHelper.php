<?php

namespace TheBachtiarz\Toolkit\Helper\App\Data;

/**
 * String Helper
 */
trait StringHelper
{
    /**
     * Create shuffle string.
     * Default: Upper Case Only
     *
     * @param integer $count
     * @param boolean $withLowerCase set true for adding lower case
     * @return string
     */
    private static function shuffleString(int $count, bool $withLowerCase = false): string
    {
        $theStr = "QWEASDZXCRTYFGHVBNUIOJKLMP";

        if ($withLowerCase)
            $theStr .= "qweasdzxcrtyfghvbnuiojklmp";

        $getStr = str_shuffle($theStr);

        return substr($getStr, 0, $count);
    }

    /**
     * Create shuffle number.
     * Length: 1 - 10 Digit(s).
     *
     * @param integer $count
     * @return string
     */
    private static function shuffleNumber(int $count): string
    {
        $theNum = (string) mt_rand(1000000000, 9999999999);

        $getNUm = str_shuffle($theNum);

        return substr($getNUm, 0, $count);
    }
}
