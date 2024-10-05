<?php

namespace App\Livewire;

use Livewire\Component;

class Calendar extends Component
{
    public $data = [];
    public function render()
    {
        $data = ['events'=>
            [ 
                'title' => 'Calendar',
                'description' => 'This is the calendar page',
                'time' => '2019-08-10 10:10:10'
            ],
            [ 
                'title' => 'Calendar',
                'description' => 'This is the calendar page',
                'time' => '2019-08-10 10:10:10'
            ],
            [ 
                'title' => 'Calendar',
                'description' => 'This is the calendar page',
                'time' => '2019-08-10 10:10:10'
            ],
            
        ];
        return view('livewire.calendar');
    }
}