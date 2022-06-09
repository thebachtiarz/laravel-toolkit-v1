<?php

namespace TheBachtiarz\Toolkit\Helper\App\Encryptor;

use Illuminate\Support\Facades\Crypt;
use TheBachtiarz\Toolkit\Helper\App\Carbon\CarbonHelper;
use TheBachtiarz\Toolkit\Helper\App\Log\ErrorLogTrait;

/**
 * Encryptor Helper
 */
trait EncryptorHelper
{
    use ErrorLogTrait, CarbonHelper;

    /**
     * Encryption simple
     *
     * @param mixed $data
     * @return string|null
     */
    private static function simpleEncrypt(mixed $data): ?string
    {
        try {
            return Crypt::encrypt([
                'type' => 'simple',
                'time' => self::anyConvDateToTimestamp(),
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            self::logCatch($th);

            return null;
        }
    }

    /**
     * Decryption global
     *
     * @param string $data
     * @return mixed
     */
    private static function decrypt(string $data): mixed
    {
        try {
            $_result = Crypt::decrypt($data);

            // If type is not simple, then must be additional action here

            return $_result['data'];
        } catch (\Throwable $th) {
            self::logCatch($th);

            return null;
        }
    }
}
