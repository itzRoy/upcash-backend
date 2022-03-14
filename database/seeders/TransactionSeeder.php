<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('transactions')->insert([
            'title' => "pay rent",
            'amount' => 200,
            'currency_id' => 1,
            'category_id' => 1,
            'note' => "lorem ipsum text",
            'recurring' => 1
        ]);

        DB::table('transactions')->insert([
            'title' => "food",
            'amount' => 300.50,
            'currency_id' => 1,
            'category_id' => 1,
            'note' => "get some stuff for home",
        ]);
    }
}
