<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Package\Rule;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class RuleFactory extends Factory
{
    
    protected $model = Rule::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            'name' => fake()->sentence(),
            'remark' => fake()->paragraphs(3, true),
            'function'=> fake()->sentence(),
            'formula'=>'',
            'status_document'=>'draft',
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}