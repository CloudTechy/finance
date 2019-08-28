<?php

use Illuminate\Database\Seeder;

class BankDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\BankDetail::class, 8)->create();
    }
}
