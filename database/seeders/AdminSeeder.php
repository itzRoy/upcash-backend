<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'username' => str::random(10),
            'password' => str::random(10)
        ]);

        DB::table('admins')->insert([
            'username' => str::random(10),
            'password' => str::random(10)
        ]);
    }
}
