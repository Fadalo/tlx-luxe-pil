<?php

namespace Database\Factories\Member;


use App\Models\Member\Member;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MemberFactory extends Factory
{

    protected $model = Member::class;
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
            
            'referal_by' => Str::random(5),
            "status_document" => $this->faker->randomElement(['draft', 'locked']),
            "created_by" => $this->faker->randomElement(['1', '2']),
            "updated_by" => $this->faker->randomElement(['1', '2'])
        ];
    }
}
