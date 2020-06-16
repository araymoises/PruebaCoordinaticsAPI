<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaction_types')->insert([
            'id' => 1,
            'description' => 'Ingreso',
            'created_at' => Carbon::now()
        ]);

        DB::table('transaction_types')->insert([
            'id' => 2,
            'description' => 'Egreso',
            'created_at' => Carbon::now()
        ]);
    }
}
