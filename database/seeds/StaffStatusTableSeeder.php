<?php

use Illuminate\Database\Seeder;

class StaffStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('staff_statuses')->insert([
            'title' => 'Active'
            
        ]);

        DB::table('staff_statuses')->insert([
            'title' => 'Suspend'
            
        ]);
    }
}
