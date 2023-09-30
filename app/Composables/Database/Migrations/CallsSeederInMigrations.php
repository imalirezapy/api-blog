<?php

namespace App\Composables\Database\Migrations;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

trait CallsSeederInMigrations
{
    private function callSeeder(string $className): void
    {
        Artisan::call('db:seed', ['--class' => $className]);
    }

    private function undoSeed(string $tableName): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table($tableName)->truncate();
        Schema::enableForeignKeyConstraints();
    }
}
