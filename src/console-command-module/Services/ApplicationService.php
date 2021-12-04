<?php

namespace TheBachtiarz\Toolkit\Console\Services;

use Illuminate\Encryption\Encrypter;

class ApplicationService
{
    /**
     * generate base64 key.
     *
     * @return string
     */
    public function generateBase64Key()
    {
        return 'base64:' . base64_encode(
            Encrypter::generateKey(config('app.cipher'))
        );
    }
}
