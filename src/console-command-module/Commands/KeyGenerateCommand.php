<?php

namespace TheBachtiarz\Toolkit\Console\Commands;

use Illuminate\Console\{Command, ConfirmableTrait};
use Illuminate\Support\Facades\Log;
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
    protected $signature = 'toolkit:key:generate {--force : Force the operation to run when in production}';

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

    public function handle(): void
    {
        try {
            $newKey = ApplicationService::generateBase64Key();

            $updateConfigData = ToolkitConfigService::name(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_KEY_NAME)
                ->value($newKey)
                ->accessGroup(ToolkitConfigInterface::TOOLKIT_CONFIG_PRIVATE_CODE)
                ->set();

            throw_if(!$updateConfigData, 'Exception', "Failed to update config app key data");

            $updateConfigFile = self::updateConfigFile(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_KEY_NAME, $newKey);

            throw_if(!$updateConfigFile, 'Exception', "Failed to update config app key file");

            Log::channel('application')->debug("- Successfully set new application key");

            $this->info('Application key set successfully.');
        } catch (\Throwable $th) {
            Log::channel('application')->debug("- Failed to set new application key: {$th->getMessage()}");

            $this->warn('Failed to set Application key.');
        }
    }
}
