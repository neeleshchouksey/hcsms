<?php

use Illuminate\Database\Seeder;

class AdminStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('admin_statuses')->insert([
            'name' => 'Active'
            
        ]);

        DB::table('admin_statuses')->insert([
            'name' => 'Suspend'
            
        ]);
    }
}
