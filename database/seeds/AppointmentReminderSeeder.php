<?php

use Illuminate\Database\Seeder;

class AppointmentReminderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('appointment_reminder_statuses')->insert([
            'name' => 'Scheduled'
            
        ]);

        DB::table('appointment_reminder_statuses')->insert([
            'name' => 'Not Active'
            
        ]);
        DB::table('appointment_reminder_statuses')->insert([
            'name' => 'Sent'
            
        ]);
    }
}
