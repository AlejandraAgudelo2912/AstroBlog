<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DatabaseBackupCommand extends Command
{
    protected $signature = 'backup:database';

    protected $description = 'Realiza un backup automático de la base de datos';

    public function handle(): void
    {
        $tables = DB::select('SHOW TABLES');
        $databaseName = config('database.connections.mysql.database');

        $backupData = [];

        foreach ($tables as $table) {
            $tableName = reset($table);
            $backupData[$tableName] = DB::table($tableName)->get();
        }

        $backupPath = 'backups/db_backup_' . now()->format('Y-m-d_H-i-s') . '.json';

        Storage::disk('local')->put($backupPath, json_encode($backupData, JSON_PRETTY_PRINT));

        $this->info("Backup saved at: storage/app/{$backupPath}");

    }
}
