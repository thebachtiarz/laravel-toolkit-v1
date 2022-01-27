<?php

namespace TheBachtiarz\Toolkit\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class LoggerBackupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'thebachtiarz:toolkit:log:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Toolkit: Backup all logger file into zip file.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
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
        $result = 0;

        try {
            $this->info('----> Logger backup, started...');

            (new Process(explode(' ', 'php artisan down')))->run();

            $this->info('~~ Application is now in maintenance mode.');

            $_zipFileLocation = "backup/log/logger_backup_" . date("ymd") . ".zip";

            $_logDirLocation = "log";

            (new Process(explode(' ', "zip -r $_zipFileLocation $_logDirLocation"), tbdirlocation()))->run();

            $this->info('- Log files compressed');

            (new Process(explode(' ', "rm -r $_logDirLocation"), tbdirlocation()))->run();

            $this->info('- Log files deleted');

            (new Process(explode(' ', 'php artisan up')))->run();

            $this->info('~~ Application is now live.');

            $this->info('----> Logger backup, success');

            $result = 1;
        } catch (\Throwable $th) {
            $this->warning('----> Logger backup, failed : ' . $th->getMessage() . $th->getLine());
        } finally {
            if (!is_dir(tbdirlocation("log")))
                mkdir(tbdirlocation("log"), 0755, true);

            return $result;
        }
    }
}
