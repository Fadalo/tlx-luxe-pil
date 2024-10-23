<?php

namespace Database\Factories\Role;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Role\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    protected $model = Role::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //

            'role_name' => fake()->name(),
            'remark'=> fake()->name(),
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
