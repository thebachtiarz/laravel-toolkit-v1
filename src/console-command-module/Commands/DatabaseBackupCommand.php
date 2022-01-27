<?php

namespace TheBachtiarz\Toolkit\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;

class DatabaseBackupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'thebachtiarz:toolkit:database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Toolkit: Backup database into zip file.';

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
            Log::channel('maintenance')->info('----> Database backup, started...');

            (new Process(explode(' ', 'php artisan down')))->run();

            Log::channel('maintenance')->info('~~ Application is now in maintenance mode.');

            $this->databaseBackupResolver();

            (new Process(explode(' ', 'php artisan up')))->run();

            Log::channel('maintenance')->info('~~ Application is now live.');

            Log::channel('maintenance')->info('----> Database backup, success');

            $result = 1;
        } catch (\Throwable $th) {
            Log::channel('maintenance')->warning("----> Database backup, failed : {$th->getMessage()}, Line: {$th->getLine()}");
        } finally {
            Log::channel('maintenance')->info('');

            return $result;
        }
    }

    /**
     * resolve database backup process
     *
     * @return boolean
     */
    private function databaseBackupResolver(): bool
    {
        $result = false;

        try {
            $_dbConnection = config('database.default');
            $_dbCredentials = [];
            $_dbBackupFileName = "";
            $_dbBackupCommand = "";

            switch ($_dbConnection) {
                case 'mysql':
                    $_dbCredentials = [
                        'host' => config("database.connections.$_dbConnection.host"),
                        'port' => config("database.connections.$_dbConnection.port"),
                        'database' => config("database.connections.$_dbConnection.database"),
                        'username' => config("database.connections.$_dbConnection.username"),
                        'password' => config("database.connections.$_dbConnection.password")
                    ];

                    $_dbBackupFileName = "{$_dbCredentials['database']}_backup_" . date("ymd_His");

                    $_dbBackupCommand = sprintf(
                        'mysqldump -h %s -P %s -u %s -p\'%s\' %s > %s',
                        $_dbCredentials['host'],
                        $_dbCredentials['port'],
                        $_dbCredentials['username'],
                        $_dbCredentials['password'],
                        $_dbCredentials['database'],
                        "$_dbBackupFileName.sql"
                    );

                    break;

                default:
                    //
                    break;
            }

            (new Process(explode(' ', $_dbBackupCommand), tbdirlocation()))->run();

            Log::channel('maintenance')->info("Successfully backup database $_dbBackupFileName.sql.");

            (new Process(explode(' ', "zip -r backup/database/$_dbBackupFileName.zip $_dbBackupFileName.sql"), tbdirlocation()))->run();

            Log::channel('maintenance')->info("Successfully compress database backup/database/$_dbBackupFileName.zip.");

            (new Process(explode(' ', "rm $_dbBackupFileName.sql"), tbdirlocation()))->run();

            Log::channel('maintenance')->info("Successfully remove backup database $_dbBackupFileName.sql.");

            $result = true;
        } catch (\Throwable $th) {
            Log::channel('maintenance')->warning("- Failed to backup database: {$th->getMessage()}");
        } finally {
            return $result;
        }
    }
}
