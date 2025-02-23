<?php

namespace Tests\Traits;

use Illuminate\Support\Facades\DB;

trait DatabaseHelpers
{
    public function disableForeignKeyChecks()
    {
        $connection = config('database.default');

        if ($connection === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        } elseif ($connection === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = OFF;');
        }
    }

    public function enableForeignKeyChecks()
    {
        $connection = config('database.default');

        if ($connection === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } elseif ($connection === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = ON;');
        }
    }

    public function getTablesQuery()
    {
        return config('database.default') === 'sqlite' ?
            "SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'"
            : 'SHOW TABLES';
    }
}
