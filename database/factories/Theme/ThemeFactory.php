<?php

namespace Database\Factories\Theme;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Theme\Theme;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ThemeFactory extends Factory
{
    
    protected $model = Theme::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            'name'=>'',
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}