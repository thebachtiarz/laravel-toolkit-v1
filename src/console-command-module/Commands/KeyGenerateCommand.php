<?php

namespace TheBachtiarz\Toolkit\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Illuminate\Support\Facades\Log;
use TheBachtiarz\Toolkit\Cache\Base\Cache as CacheBase;
use TheBachtiarz\Toolkit\Cache\Interfaces\Data\ApplicationDataInterface;
use TheBachtiarz\Toolkit\Cache\Service\Cache as CacheService;
use TheBachtiarz\Toolkit\Console\Services\ApplicationService;

class KeyGenerateCommand extends Command
{
    use ConfirmableTrait;

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
            $key = $this->applicationService->generateBase64Key();

            if (CacheService::has(ApplicationDataInterface::TOOLKIT_APP_KEY_CACHE_NAME)) {
                $currentKey = CacheBase::appKey();

                throw_if(((strlen($currentKey) !== 0) && (!$this->confirmToProceed())), 'Exception', "");
            }

            CacheService::set(ApplicationDataInterface::TOOLKIT_APP_KEY_CACHE_NAME, $key);

            Log::channel('application')->debug("- Successfully set new application key");

            $this->info('Application key set successfully.');
        } catch (\Throwable $th) {
            Log::channel('application')->debug("- Failed to set new application key: {$th->getMessage()}");

            $this->warn('Failed to set Application key.');
        }
    }
}
