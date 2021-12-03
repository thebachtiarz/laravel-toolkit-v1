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

    /**
     * replace [toolkit] config static value
     *
     * sample : ['key' => 'app_key', 'old' => config('thebachtiarz_toolkit.app_key'), 'new' => $newKey, 'tag_value' => '"']
     *
     * @param array $replaces
     * @return boolean
     */
    public function replaceToolkitConfigFile(array $replaces = []): bool
    {
        try {
            $configPath = config_path('thebachtiarz_toolkit.php');
            $_isFileExist = file_exists($configPath);
            if ($_isFileExist) {
                foreach ($replaces as $key => $replace) {
                    file_put_contents(
                        $configPath,
                        str_replace(
                            "'{$replace['key']}' => {$replace['tag_value']}{$replace['old']}{$replace['tag_value']}",
                            "'{$replace['key']}' => {$replace['tag_value']}{$replace['new']}{$replace['tag_value']}",
                            file_get_contents($configPath)
                        )
                    );
                }
            }
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
