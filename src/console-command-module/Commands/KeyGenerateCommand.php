<?php

namespace TheBachtiarz\Toolkit\Console\Commands;

use Illuminate\Console\{Command, ConfirmableTrait};
use Illuminate\Support\Facades\{Artisan, Log};
use TheBachtiarz\Toolkit\Config\Helper\ConfigHelper;
use TheBachtiarz\Toolkit\Config\Interfaces\Data\ToolkitConfigInterface;
use TheBachtiarz\Toolkit\Config\Service\ToolkitConfigService;
use TheBachtiarz\Toolkit\Console\Service\ApplicationService;

class KeyGenerateCommand extends Command
{
    use ConfirmableTrait, ConfigHelper;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'thebachtiarz:toolkit:key:generate {--force : Force operation to update key even key exists or in production}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Toolkit: Set the application key';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $currentKey = tbtoolkitconfig('app_key');

        $proposedKey = ApplicationService::generateBase64Key();

        try {
            if (iconv_strlen($currentKey)) {
                throw_if(!($this->hasOption('force') && $this->option('force')), 'Exception', "");

                throw_if(!$this->confirmToProceed(), 'Exception', "");

                $this->updateAppKeyConfig($proposedKey);
            } else {
                $this->updateAppKeyConfig($proposedKey);
            }
        } catch (\Throwable $th) {
            $proposedKey = $currentKey;
        }

        try {
            $updateConfigData = ToolkitConfigService::name(ToolkitConfigInterface::TOOLKIT_CONFIG_PREFIX_NAME . "/" . ToolkitConfigInterface::TOOLKIT_CONFIG_APP_KEY_NAME)
                ->value($proposedKey)
                ->accessGroup(ToolkitConfigInterface::TOOLKIT_CONFIG_PRIVATE_CODE)
                ->set();

            throw_if(!$updateConfigData, 'Exception', "Failed to update config app key data");

            Artisan::call('config:cache');

            Log::channel('application')->info("- Successfully set new application key");

            $this->info('Application key set successfully.');

            return 1;
        } catch (\Throwable $th) {
            Log::channel('application')->warning("- Failed to set new application key: {$th->getMessage()}");

            $this->warn('Failed to set Application key.');

            return 0;
        }
    }

    /**
     * update app key in config file
     *
     * @param string $proposedKey
     * @return void
     */
    private function updateAppKeyConfig(string $proposedKey): void
    {
        $updateConfigFile = self::updateConfigFile(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_KEY_NAME, $proposedKey);

        throw_if(!$updateConfigFile, 'Exception', "Failed to update config app key file");
    }
}
