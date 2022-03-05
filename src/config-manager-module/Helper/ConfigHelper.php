<?php

namespace TheBachtiarz\Toolkit\Config\Helper;

use TheBachtiarz\Toolkit\Config\Interfaces\Config\ConfigPropertyInterface;
use TheBachtiarz\Toolkit\Helper\App\Log\ErrorLogTrait;
use TheBachtiarz\Toolkit\ToolkitInterface;

class ConfigHelper
{
    use ErrorLogTrait;

    /**
     * config name.
     * default: thebachtiarz_toolkit
     *
     * @var string
     */
    protected static string $configName = ToolkitInterface::TOOLKIT_CONFIG_NAME;

    /**
     * data type.
     * default: null
     *
     * @var string|null
     */
    protected static ?string $dataType = null;

    /**
     * keep data type proposed is static
     *
     * @var boolean
     */
    private static bool $dataTypeProposed = false;

    // ? Public Methods
    /**
     * update config file value
     *
     * @param string $key
     * @param mixed $value
     * @return boolean
     */
    public static function updateConfigFile(string $key, mixed $value = null): bool
    {
        return self::replaceToolkitConfigFile([
            [
                'key' => $key,
                'old' => config(self::$configName . ".{$key}"),
                'new' => $value
            ]
        ]);
    }

    /**
     * replace file config static value
     *
     * sample : [['key' => 'app_key', 'old' => config('thebachtiarz_toolkit.app_key'), 'new' => $newKey]]
     *
     * @param array[] $replaces
     * @return boolean
     */
    public static function replaceToolkitConfigFile(array $replaces = []): bool
    {
        try {
            $configPath = config_path(self::$configName . ".php");
            $_isFileExist = file_exists($configPath);
            throw_if(!$_isFileExist, 'Exception', "Config file: {$configPath} - does't exist");

            if ($_isFileExist) {
                foreach ($replaces as $key => $replace) {
                    $_oldValue = self::valueResolver($replace['old']);
                    $_newValue = self::valueResolver($replace['new']);

                    file_put_contents(
                        $configPath,
                        str_replace(
                            "'{$replace['key']}' => {$_oldValue}",
                            "'{$replace['key']}' => {$_newValue}",
                            file_get_contents($configPath)
                        )
                    );
                }
            }

            return true;
        } catch (\Throwable $th) {
            self::logCatch($th);

            return false;
        }
    }

    // ? Private Methods
    /**
     * value resolver
     *
     * @param mixed $value
     * @return mixed
     */
    private static function valueResolver(mixed $value)
    {
        $result = null;

        try {
            if (!self::$dataType)
                self::$dataType = gettype($value);

            $_tagValue = self::tagValueResolver();

            $result = "{$_tagValue}{$value}{$_tagValue}";

            if (in_array(self::$dataType, ConfigPropertyInterface::PROPERTY_CONFIG_TAG_WITHOUT_QUOTE_AVAILABLE))
                $result = $value ? 'true' : 'false';
        } catch (\Throwable $th) {
            self::logCatch($th);
        } finally {
            if (!self::$dataTypeProposed)
                self::$dataType = null;

            return $result;
        }
    }

    /**
     * resolve tag value by data type
     *
     * @return string
     */
    private static function tagValueResolver(): string
    {
        $result = ConfigPropertyInterface::PROPERTY_CONFIG_TAG_DOUBLE_QUOTE_CODE;

        if (in_array(self::$dataType, ConfigPropertyInterface::PROPERTY_CONFIG_TAG_DOUBLE_QUOTE_AVAILABLE))
            $result = ConfigPropertyInterface::PROPERTY_CONFIG_TAG_DOUBLE_QUOTE_CODE;

        if (in_array(self::$dataType, ConfigPropertyInterface::PROPERTY_CONFIG_TAG_SINGLE_QUOTE_AVAILABLE))
            $result = ConfigPropertyInterface::PROPERTY_CONFIG_TAG_SINGLE_QUOTE_CODE;

        if (in_array(self::$dataType, ConfigPropertyInterface::PROPERTY_CONFIG_TAG_WITHOUT_QUOTE_AVAILABLE))
            $result = ConfigPropertyInterface::PROPERTY_CONFIG_TAG_WITHOUT_QUOTE_CODE;

        return $result;
    }

    // ? Setter Modules
    /**
     * Set config name
     *
     * @param string $configName default: thebachtiarz_toolkit
     * @return self
     */
    public static function setConfigName(string $configName = ToolkitInterface::TOOLKIT_CONFIG_NAME): self
    {
        self::$configName = $configName;

        return new self;
    }

    /**
     * Set data type.
     *
     * @param string $dataType data type.
     * @return self
     */
    public static function setDataType(string $dataType): self
    {
        self::$dataType = $dataType;

        self::$dataTypeProposed = true;

        return new self;
    }
}
