<?php

use TheBachtiarz\Toolkit\ToolkitInterface;

/**
 * TheBachtiarz toolkit config
 *
 * @param string|null $keyName config key name | null will return all
 * @return mixed
 */
function tbtoolkitconfig(?string $keyName = null): mixed
{
    $configName = ToolkitInterface::TOOLKIT_CONFIG_NAME;

    return iconv_strlen($keyName)
        ? config("{$configName}.{$keyName}")
        : config("{$configName}");
}

/**
 * Get location from thebachtiarz directory
 *
 * @param string|null $subDir
 * @return string
 */
function tbdirlocation(?string $subDir = null): string
{
    $_subDir = $subDir ? "/{$subDir}" : "";

    return base_path(ToolkitInterface::TOOLKIT_DIRECTORY_PATH) . $_subDir;
}

/**
 * TheBachtiarz toolkit route api file location
 *
 * @return string
 */
function tbtoolkitrouteapi(): string
{
    return base_path('vendor/thebachtiarz/laravel-toolkit-v1/src/toolkit-backend-service/routes/toolkit_api.php');
}
