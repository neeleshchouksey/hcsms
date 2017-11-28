<?php

use Illuminate\Database\Seeder;

class RemindarTimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
          DB::table('remider_times')->insert([
            'title' => '8:00 Am',
            'abbr'	=> '8:00 ',
            'isdefault'=>1

            
        ]);

        DB::table('remider_times')->insert([
            'title' => '9:00 AM',
            'abbr'	=> '9:00',
            'isdefault'=>0
        ]);
         DB::table('remider_times')->insert([
            'title' => '10:00 am',
            'abbr'	=> '10:00',
            'isdefault'=>0
            
        ]);

        DB::table('remider_times')->insert([
            'title' => '11:00 Am',
            'abbr'	=> '11:00',
            'isdefault'=>0
        ]);
         DB::table('remider_times')->insert([
            'title' => '12:00 PM',
            'abbr'	=> '12:00',
            'isdefault'=>0
            
        ]);

        DB::table('remider_times')->insert([
            'title' => '1:00 PM',
            'abbr'	=> '13:00',
            'isdefault'=>0
        ]);
        DB::table('remider_times')->insert([
            'title' => '2:00 PM',
            'abbr'	=> '14:00',
            'isdefault'=>0
        ]);
        DB::table('remider_times')->insert([
            'title' => '3:00 PM',
            'abbr'	=> '15:00',
            'isdefault'=>0
        ]);
        DB::table('remider_times')->insert([
            'title' => '4:00 PM',
            'abbr'	=> '16:00',
            'isdefault'=>0
        ]);
        DB::table('remider_times')->insert([
            'title' => '5:00 PM',
            'abbr'	=> '17:00',
            'isdefault'=>0
        ]);
        DB::table('remider_times')->insert([
            'title' => '6:00 PM',
            'abbr'	=> '18:00',
            'isdefault'=>0
        ]);
        DB::table('remider_times')->insert([
            'title' => '7:00 PM',
            'abbr'	=> '19:00',
            'isdefault'=>1
        ]);
        DB::table('remider_times')->insert([
            'title' => '8:00 PM',
            'abbr'	=> '20:00',
            'isdefault'=>0
        ]);
        DB::table('remider_times')->insert([
            'title' => '9:00 PM',
            'abbr'	=> '21:00',
            'isdefault'=>0
        ]);
        DB::table('remider_times')->insert([
            'title' => '10:00 PM',
            'abbr'	=> '22:00',
            'isdefault'=>0
        ]);
    }
}
