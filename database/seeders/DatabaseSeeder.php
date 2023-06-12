<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
            'usuarios',
        ]);

        $this->call([
            UsuarioSeeder::class
        ]);
    }

    protected function truncateTables(array $tables)
    {
        foreach ($tables as $table)
        {
    		DB::table($table)->truncate();
    	}
    }
}
