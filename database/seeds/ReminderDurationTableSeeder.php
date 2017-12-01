<?php

use Illuminate\Database\Seeder;

class ReminderDurationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('remindar_durations')->insert([
            'title' => 'Day',
            'abbr'	=> 'day',
            'isdefault'=>0

            
        ]);
        DB::table('remindar_durations')->insert([
            'title' => 'Week',
            'abbr'	=> 'week',
            'isdefault'=>1

            
        ]);
        DB::table('remindar_durations')->insert([
            'title' => 'Month',
            'abbr'	=> 'month',
            'isdefault'=>0

            
        ]);
    }
}
