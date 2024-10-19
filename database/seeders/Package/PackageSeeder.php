<?php

namespace Database\Seeders\Package;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Package\Package;
use App\Models\Package\PackageVariant;


class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Package::factory()->count(10)->create();
        Package::factory()->createMany([
            [
                "name" => 'Private',
                "desc" => 'Private Package',
                "status_document" => 'locked',
                "created_by" => 1,
                "updated_by" => 1
            ],
            [
                "name" => 'Group',
                "desc" => 'Group Package',
                "status_document" => 'locked',
                "created_by" => 1,
                "updated_by" => 1
            ]]);
        
        PackageVariant::factory()->createMany([
            [
                "name" => 'Private - Single',
                "package_id"=> 1,
                "desc" => 'Private - Single',
                "package_qty_ticket" => '10',
                "status_document" => 'draft',
                "created_by" => 1,
                "updated_by" => 1
            ],
            [
                "name" => 'Private - Duo',
                "package_id"=> 1,
                "desc" => 'Private - Duo',
                "package_qty_ticket" => '10',
                "status_document" => 'draft',
                "created_by" => 1,
                "updated_by" => 1
            ],
            [
                "name" => 'Private - Trio',
                "package_id"=> 1,
                "desc" => 'Private - Trio',
                "package_qty_ticket" => '10',
                "status_document" => 'draft',
                "created_by" => 1,
                "updated_by" => 1
            ],
            [
                "name" => 'Group - Regular',
                "package_id"=> 2,
                "desc" => 'Group Regular',
                "package_qty_ticket" => '10',
                "status_document" => 'draft',
                "created_by" => 1,
                "updated_by" => 1
            ],
            [
                "name" => 'Group - Happy Hour',
                "package_id"=> 2,
                "desc" => 'Group Regular',
                "package_qty_ticket" => '10',
                "status_document" => 'draft',
                "created_by" => 1,
                "updated_by" => 1
            ]
        ]);
   
    }
}
