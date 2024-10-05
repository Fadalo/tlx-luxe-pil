<?php

namespace Database\Factories\Instructor;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Instructor\Instructor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class InstructorFactory extends Factory
{
    protected $model = Instructor::class;
    protected static ?string $password;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'phone_no'=>fake()->phoneNumber(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'birthday' => fake()->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d'),   
            'pin' => static::$password ??= Hash::make('1234'),   
            
            'join_date' => fake()->date(),      
            'actived_date' => fake()->date(),
            "status" => $this->faker->randomElement(['draft', 'locked']),
            "status_document" => $this->faker->randomElement(['draft', 'locked']),
            "created_by" => $this->faker->randomElement(['1', '2']),
            "updated_by" => $this->faker->randomElement(['1', '2'])
        ];
    }
}
