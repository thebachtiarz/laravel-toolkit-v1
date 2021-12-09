<?php

namespace TheBachtiarz\Toolkit\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Illuminate\Support\Facades\Log;
use TheBachtiarz\Toolkit\Cache\Base\Cache as CacheBase;
use TheBachtiarz\Toolkit\Cache\Service\Cache as CacheService;
use TheBachtiarz\Toolkit\Config\Helper\ConfigHelper;
use TheBachtiarz\Toolkit\Config\Interfaces\Data\ToolkitConfigInterface;
use TheBachtiarz\Toolkit\Config\Service\ToolkitConfigService;
use TheBachtiarz\Toolkit\Console\Service\ApplicationService;
use TheBachtiarz\Toolkit\ToolkitInterface;

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

    public function __construct(
        ApplicationService $applicationService
    ) {
        parent::__construct();
        $this->applicationService = $applicationService;
    }

    public function handle(): void
    {
        try {
            $newKey = $this->applicationService->generateBase64Key();

            if (CacheService::has(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_KEY_NAME)) {
                $currentKey = CacheBase::appKey();

                throw_if(((strlen($currentKey) !== 0) && (!$this->confirmToProceed())), 'Exception', "");
            }

            ToolkitConfigService::name(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_KEY_NAME)
                ->value($newKey)
                ->accessGroup(ToolkitConfigInterface::TOOLKIT_CONFIG_PRIVATE_CODE)
                ->set();

            self::replaceToolkitConfigFile([
                [
                    'key' => ToolkitConfigInterface::TOOLKIT_CONFIG_APP_KEY_NAME,
                    'old' => tbtoolkitconfig(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_KEY_NAME),
                    'new' => $newKey,
                    'tag_value' => '"'
                ]
            ]);

            Log::channel('application')->debug("- Successfully set new application key");

            $this->info('Application key set successfully.');
        } catch (\Throwable $th) {
            Log::channel('application')->debug("- Failed to set new application key: {$th->getMessage()}");

            $this->warn('Failed to set Application key.');
        }
    }
}
