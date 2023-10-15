<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name'          => 'Ahmed Taha',
            'email'         => 'ahmed@yahoo.com',
            'password'      => Hash::make("ahmed"),
            'phone_number'  => '01027647766'
        ]);
    }
}
