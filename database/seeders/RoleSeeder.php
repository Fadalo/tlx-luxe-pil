<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Role::factory()->create([
            'role_name' => 'SuperAdmin',
            'remark' => 'This Is Super Admin',
            'updated_by' => 1,
            'created_by' => 1
        ]);
        //User::factory()->count(2)->create();
    }

    
}
