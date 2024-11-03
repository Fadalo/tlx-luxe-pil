<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Package\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Rule::factory()->createMany([[
            'name' => 'DAY=H-1 TIME>=18:00',
            'remark' => 'JIKA MEMBER TELAH BOOKING DAN HARI ADALAH H-1 DAN JAM SEBELUM 18:00 - PROSESS DI  LANJUTKAN',
            'function'=>'func_H1_TLessThan18',
            'formula'=>'{
                        "condition": {
                            "member_status": "booked",
                            "days_before": 1,
                            "current_time": {
                            "before": "18:00"
                            }
                        },
                        "action": "proceed"
                        }
                        ',
            'status_document'=>'draft',
            'updated_by' => 1,
            'created_by' => 1
        ],
        [
            'name' => 'TIME>=00:10',
            'remark' => 'JIKA MEMBER BARU BOOKING DAN TIME >=10 menit - PROSESS DI  LANJUTKAN',
            'function'=>'func_H1_TLessThan18',
            'formula'=>'{
                            "condition": {
                                "member_status": "booked",
                                "days_before": 1,
                                "current_time": {
                                "before": "18:00"
                                }
                            },
                            "action": "proceed"
                        }',
            'status_document'=>'draft',
            'updated_by' => 1,
            'created_by' => 1
        ]
        ]);
        //User::factory()->count(2)->create();
    }

    
}