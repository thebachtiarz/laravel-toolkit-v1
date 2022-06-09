<?php

namespace TheBachtiarz\Toolkit\Console\Service;

use Illuminate\Encryption\Encrypter;

class ApplicationService
{
    /**
     * Generate base64 key.
     *
     * @return string
     */
    public static function generateBase64Key(): string
    {
        return 'base64:' . base64_encode(
            Encrypter::generateKey(config('app.cipher'))
        );
    }
}
