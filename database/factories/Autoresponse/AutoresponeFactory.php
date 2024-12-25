<?php

namespace Database\Factories\Autoresponse;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Autoresponse\Autoresponse;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class AutoresponseFactory extends Factory
{
    
    protected $model = Autoresponse::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            'module' => 'memberRegister',
            'type' => 'member',
            'templete'=> fake()->sentence(),
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}