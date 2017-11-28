<?php

use Illuminate\Database\Seeder;

class RemindarDaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('reminder_days')->insert([
            'title' => 'Monday',
            'abbr'	=> 'mon',
            'isdefault'=>1

            
        ]);

        DB::table('reminder_days')->insert([
            'title' => 'TuesDay',
            'abbr'	=> 'tue',
            'isdefault'=>0
        ]);
         DB::table('reminder_days')->insert([
            'title' => 'Wednesday',
            'abbr'	=> 'wed',
            'isdefault'=>0
            
        ]);

        DB::table('reminder_days')->insert([
            'title' => 'Thursday',
            'abbr'	=> 'thu',
            'isdefault'=>0
        ]);
         DB::table('reminder_days')->insert([
            'title' => 'Friday',
            'abbr'	=> 'fri',
            'isdefault'=>1
            
        ]);

        DB::table('reminder_days')->insert([
            'title' => 'Saturday',
            'abbr'	=> 'sat',
            'isdefault'=>0
        ]);
    }
}
