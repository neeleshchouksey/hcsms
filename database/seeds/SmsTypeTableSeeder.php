<?php

use Illuminate\Database\Seeder;

class SmsTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('service_sms_types')->insert([
            'name' => 'Doctor'
            
        ]);
    }
}
