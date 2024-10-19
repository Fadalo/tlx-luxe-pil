<?php

namespace Database\Seeders\Member;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Member\Member;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create(); // Initialize Faker instance

        // Create a specific member entry
        Member::factory()->create([
            'phone_no' => '+6282177522260',
            'first_name' => 'Member 01',
            'last_name' => 'Jono',
            'birthday' => $faker->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d'),
            'pin' => Hash::make('1234'),
            'join_date' => $faker->date(),
            'actived_date' => $faker->date(),
            'referal_by' => Str::random(5),
            'status_document' => $faker->randomElement(['draft', 'locked']),
            'created_by' => $faker->randomElement(['1', '2']),
            'updated_by' => $faker->randomElement(['1', '2']),
        ]);

        // Generate 10 additional members
        Member::factory()->count(10)->create();
    }
}
