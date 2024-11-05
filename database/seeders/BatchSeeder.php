<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Batch\Batch;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class BatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Batch::factory()->create([
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
        ]);



        //User::factory()->count(2)->create();
    }

    
}
