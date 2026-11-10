<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('student')->insert([
            [
                'first_name' => 'Juan',
                'middle_initial' => 'S.',
                'last_name' => 'Dela Cruz',
                'email' => 'juan12@example.com',
                'phone' => '09123456789',
                'course' => 'BS Information Technology',
                'year' => '1st Year',
                'address' => 'Bislig City, Surigao del Sur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Pedro',
                'middle_initial' => null,
                'last_name' => 'Garcia',
                'email' => 'pedro12@example.com',
                'phone' => '09987654321',  
                'course' => 'BS Computer Science',
                'year' => '2nd Year',
                'address' => 'Tagbina, Surigao del Sur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    
    }
}
