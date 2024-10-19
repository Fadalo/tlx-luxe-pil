<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
class Calendar extends Component
{
    public $events = [];

    public function mount()
    {
        // Load initial events (You can fetch from DB)
        
        $this->events = [
            [
                'title' => 'Session 1 - Private - Single', 
                'description'=> 'Discuss project milestones and deliverables.',
                'start' => Carbon::createFromFormat('d/m/Y H:i:s', '16/10/2024 10:00:00')->format('Y-m-d H:i:s'),
                'end' =>  Carbon::createFromFormat('d/m/Y H:i:s', '16/10/2024 10:00:00')->addHours(2)->format('Y-m-d H:i:s'),
                'backgroundColor' => '#ff5733',
            ],
            [
                'title' => 'Session 2 - Private -Single', 
                'description'=> 'Discuss project milestones and deliverables.',
                'start' => Carbon::createFromFormat('d/m/Y H:i:s', '16/10/2024 10:00:00')->addDay()->format('Y-m-d H:i:s'),
                'end' => Carbon::createFromFormat('d/m/Y H:i:s', '16/10/2024 10:00:00')->addDay()->addHours(2)->format('Y-m-d H:i:s')
            ],
            [
                'title'=> 'Recurring Event',
                'rrule'=> [
                    'freq'=> 'weekly',           // Weekly recurrence
                    'byweekday'=> ['MO', 'TU', 'FR'],  // Monday, Tuesday, Friday
                    'dtstart'=> Carbon::createFromFormat('d/m/Y H:i:s', '16/10/2024 08:00:00'), // Start datetime
                ],
                'duration' => '02:00'
            ],
        ];
    }

    public function addEvent($event)
    {
        $this->events[] = $event;  // Add event to the array
    }
    public function render()
    {
        return view('livewire.calendar');
    }
}
