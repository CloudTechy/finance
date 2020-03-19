<?php

use Illuminate\Database\Seeder;

class DurationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$durations = ['Three Days' => 3, 'A Week' => 7,'A Month' => 30, 'Two Months' => 60, 'Three Months' => 90,'Six Months' => 180,'A Year' => 365];
    	foreach ($durations as $duration => $value) {
    		factory(App\Duration::class, 1)->create(['duration' => $value, 'description' => $duration]);
    	}
        
    }
}
