<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DatabaseBackupCommand extends Command
{
    protected $signature = 'backup:database';

    protected $description = 'Realiza un backup automático de la base de datos';

    public function handle(): void
    {
        $connection = config('database.default');

        if ($connection === 'sqlite') {
            $tables = DB::select("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'");
        } else {
            $tables = DB::select('SHOW TABLES');
        }

        if (empty($tables)) {
            $this->warn("No se encontraron tablas en la base de datos.");
            return;
        }

        $backupData = [];

        foreach ($tables as $table) {
            $tableName = $connection === 'sqlite' ? $table->name : reset($table);

            $backupData[$tableName] = DB::table($tableName)->get();
        }

        $backupPath = 'backups/db_backup_' . now()->format('Y-m-d_H-i-s') . '.json';

        Storage::disk('local')->put($backupPath, json_encode($backupData, JSON_PRETTY_PRINT));

        $this->info("Backup saved at: storage/app/{$backupPath}");
    }
}
