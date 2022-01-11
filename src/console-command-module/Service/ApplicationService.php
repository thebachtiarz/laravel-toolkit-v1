<?php

namespace TheBachtiarz\Toolkit\Console\Service;

use Illuminate\Encryption\Encrypter;

class ApplicationService
{
    /**
     * generate base64 key.
     *
     * @return string
     */
    public static function generateBase64Key()
    {
        return 'base64:' . base64_encode(
            Encrypter::generateKey(config('app.cipher'))
        );
    }
}
