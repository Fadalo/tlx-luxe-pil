<?php

namespace Database\Factories\Batch;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MenuAdmin>
 */
class BatchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => 'Batch 1 November 04-11-2024 s/d 15-11-2024',
            'remark' => 'Batch 1 November 04-11-2024 s/d 15-11-2024',
            'status' => 1,
            'instructor_id' => 1,
            'package_id'=> 1,
            'start_datetime' => '2024-11-04 10:00:00',
            'end_datetime' => '2024-11-04 10:00:00',
            'qty_book' => 0,
            'qty_max' => 8,
            'status_document' => 'draft'
        ];
    }
}
