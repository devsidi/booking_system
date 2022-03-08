<?php

namespace Database\Seeders;
use App\Models\Role;
use App\Models\provider;
use App\Models\provider_type;
use App\Models\Services;
use App\Models\state;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // status 0 is inactive and 1 is active
        provider::create(['name'=>'Doctor','status'=>'1']);
        provider::create(['name'=>'Meeting room','status'=>'1']);
        provider::create(['name'=>'Company Car','status'=>'1']);

        Role::create(['name'=>'doctor']);
        Role::create(['name'=>'admin']);
        Role::create(['name'=>'customer']);
        Role::create(['name'=>'superadmin']);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'dev.md.sidi@gmail.com',
            'role_id' => '2',
            'password' => Hash::make('admin@888'),
          ]);
        DB::table('users')->insert([
            'name' => 'superadmin',
            'email' => 'md.sidi93@gmail.com',
            'role_id' => '4',
            'password' => Hash::make('superadmin@888'),
          ]);

        Services::create(['name'=>'Fomema Examination','provider_id'=>'1']);
        Services::create(['name'=>'X-ray','provider_id'=>'1']);
        Services::create(['name'=>'Auto','provider_id'=>'3']);
        Services::create(['name'=>'Manual','provider_id'=>'3']);
        Services::create(['name'=>'Discussion','provider_id'=>'2']);
        Services::create(['name'=>'Event','provider_id'=>'2']);
        
        state::create(['name'=>'Kedah']);
        state::create(['name'=>'Johor']);
        state::create(['name'=>'Kelantan']);
        state::create(['name'=>'Kuala Lumpur']);
        state::create(['name'=>'Melaka']);
        state::create(['name'=>'Negeri Sembilan']);
        state::create(['name'=>'Pahang']);
        state::create(['name'=>'Perak']);
        state::create(['name'=>'Perlis']);
        state::create(['name'=>'Pulau Pinang']);
        state::create(['name'=>'Sabah']);
        state::create(['name'=>'Sarawak']);
        state::create(['name'=>'Terengganu']);
        state::create(['name'=>'Selangor']);
        state::create(['name'=>'Putrajaya']);
        state::create(['name'=>'Labuan']);

        provider_type::create(['name'=>'Sedan','provider_id'=>'3']);
        provider_type::create(['name'=>'Hatchback','provider_id'=>'3']);
        provider_type::create(['name'=>'Mid-size Pickup Truck','provider_id'=>'3']);
        provider_type::create(['name'=>'Compact MPV','provider_id'=>'3']);
        provider_type::create(['name'=>'Conference room','provider_id'=>'2']);
        provider_type::create(['name'=>'Auditorium','provider_id'=>'2']); 
        provider_type::create(['name'=>'Meeting','provider_id'=>'2']);
        provider_type::create(['name'=>'General Practitioner','provider_id'=>'1']);
        provider_type::create(['name'=>'Clinical Haematology','provider_id'=>'1']);
        provider_type::create(['name'=>'Endocrinology','provider_id'=>'1']);
        provider_type::create(['name'=>'Family Medicine','provider_id'=>'1']);
    }
}
