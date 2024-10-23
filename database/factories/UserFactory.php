<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    //protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'role_id'=> 1,
            'name' => fake()->name(),
            'phoneno'=>$this->generateFakePhone(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '1234',
            'remember_token' => Str::random(10),
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }

    /**
     * 
     *       // 'password' => static::$password ??= Hash::make('password'),
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    private function generateFakePhone(): string
    {
        //$faker = Faker::create();
        $phone_no = '+628' . fake()->numberBetween(1000000000, 9999999999);

        return $phone_no;
    }
}
