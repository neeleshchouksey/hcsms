<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PracticeTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        DB::table('practice_types')->insert([
            'name' => 'Doctor'
            
        ]);

        DB::table('practice_types')->insert([
            'name' => 'Dentist'
            
        ]);
    }
}
