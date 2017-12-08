<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ReminderDurationTableSeeder::class);
        $this->call(PracticeTypesTableSeeder::class);
        $this->call(RemindarTimesTableSeeder::class);
        $this->call(StaffStatusTableSeeder::class);
        $this->call(RemindarDaysTableSeeder::class);

        	
    }
}
