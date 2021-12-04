<?php

namespace TheBachtiarz\Toolkit\Config\Helper;

use Illuminate\Support\Facades\Log;

trait ConfigHelper
{
    /**
     * replace [toolkit] config static value
     *
     * sample : ['key' => 'app_key', 'old' => config('thebachtiarz_toolkit.app_key'), 'new' => $newKey, 'tag_value' => '"']
     *
     * @param array $replaces
     * @return boolean
     */
    public static function replaceToolkitConfigFile(array $replaces = []): bool
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
            Log::channel('error')->error($th->getMessage());
            return false;
        }
    }
}
