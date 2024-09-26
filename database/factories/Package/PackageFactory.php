<?php

namespace Database\Factories\Package;

use App\Models\Package\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PackageFactory extends Factory
{

    protected $model = Package::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            "name" => fake()->name(),
            "desc" => fake()->text(),
            "status_document" => $this->faker->randomElement(['draft', 'locked']),
            "created_by" => $this->faker->randomElement(['1', '2']),
            "updated_by" => $this->faker->randomElement(['1', '2'])
        ];
    }
}
