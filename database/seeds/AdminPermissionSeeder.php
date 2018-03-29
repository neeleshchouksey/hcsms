<?php

use Illuminate\Database\Seeder;

class AdminPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('admin_permissions')->insert([
            'label' => 'Add new users',
            'slug' =>'users'
            
        ]);
        DB::table('admin_permissions')->insert([
            'label' => 'Languages',
            'slug' =>'languages'
            
        ]);
        DB::table('admin_permissions')->insert([
            'label' => 'Customers',
            'slug' =>'customers'
            
        ]);
        DB::table('admin_permissions')->insert([
            'label' => 'Patients',
            'slug' =>'patients'
            
        ]);
        DB::table('admin_permissions')->insert([
            'label' => 'Message Log',
            'slug' =>'messages-log'
            
        ]);


    }
}
