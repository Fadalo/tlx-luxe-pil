<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        User::factory()->create([
            'role_id' => 1,
            'name' => 'rickyss',
            'phoneno' => '+6282177522260',
            'email' => 'setiawan.ricky@gmail.com',
            'password'=>Hash::make('1234'),
            'remember_token' => Str::random(10),
            'updated_by' => 1,
            'created_by' => 1
        ]);
        User::factory()->count(2)->create();
    }

    
}
