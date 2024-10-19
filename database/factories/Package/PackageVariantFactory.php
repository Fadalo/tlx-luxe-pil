<?php

namespace Database\Factories\Package;

use App\Models\Package\PackageVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PackageVariantFactory extends Factory
{

    protected $model = PackageVariant::class;

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
            "package_id"=>$this->faker->randomElement(['1', '2']),
            "desc" => fake()->text(),
            "package_qty_ticket" => $this->faker->randomElement(['10', '20']),
            "status_document" => $this->faker->randomElement(['draft', 'locked']),
            "created_by" => $this->faker->randomElement(['1', '2']),
            "updated_by" => $this->faker->randomElement(['1', '2'])
        ];
    }
}

