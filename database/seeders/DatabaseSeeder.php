<?php

namespace Database\Seeders;

use App\Models\User;
use App\Http\Models\Package\Package;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\Package\PackageSeeder;
use Database\Seeders\Member\MemberSeeder;
use Database\Seeders\UserSeeder;




class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        /*
        User::factory()->create([
            'name' => 'Test User',
            'phoneno' => '+982738191',
            'email' => 'test@example.com',
        ]);
        */
        $this->call([
            PackageSeeder::class,
            UserSeeder::class,
            MemberSeeder::class,
        ]);

    }
}
