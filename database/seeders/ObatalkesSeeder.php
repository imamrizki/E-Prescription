<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObatalkesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = public_path('db_master/obatalkes_m.sql');
        $sql = file_get_contents($path);
        DB::unprepared($sql);
    }
}
