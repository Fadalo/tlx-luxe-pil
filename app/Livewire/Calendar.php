<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Instructor\InstructorContract;

class Calendar extends Component
{
    public $events = [];
    public $instructor_id = '';
    public $config = [];
    protected $listeners = ['updateDataCalendar'];

    public function updateDataCalendar($event)
    {
       // dd($event);
        $newEvent = $event['event'];
        $this->events = [];
       //print_r($newEvent);
       // exit();
        $this->addEvent($newEvent);
        $this->dispatch('refreshCalendar',['event1'=>$newEvent]);
        //dd($this->events);
    }
    public function update()
    {
        
    }
    public function mount()
    {
        // Load initial events (You can fetch from DB)
        $contract = InstructorContract::where('instructor_id',$this->instructor_id);
        
        
        $this->events = [
            [
                'title' => 'Session 1 - Private - Single', 
                'description'=> 'Discuss project milestones and deliverables.',
                'start' => Carbon::createFromFormat('d/m/Y H:i', '16/10/2024 10:00')->format('Y-m-d H:i'),
                'end' =>  Carbon::createFromFormat('d/m/Y H:i', '16/10/2024 10:00')->addHours(2)->format('Y-m-d H:i'),
                'backgroundColor' => '#ff5733',
            ],
            [
                'title' => 'Session 2 - Private -Single', 
                'description'=> 'Discuss project milestones and deliverables.',
                'start' => Carbon::createFromFormat('d/m/Y H:i', '16/10/2024 10:00')->addDay()->format('Y-m-d H:i'),
                'end' => Carbon::createFromFormat('d/m/Y H:i', '16/10/2024 10:00')->addDay()->addHours(2)->format('Y-m-d H:i')
            ],
            [
                'title'=> 'Recurring Event',
                'rrule'=> [
                    'freq'=> 'weekly',           // Weekly recurrence
                    'byweekday'=> ['MO', 'TU', 'FR'],  // Monday, Tuesday, Friday
                    'dtstart'=> Carbon::createFromFormat('d/m/Y H:i', '16/10/2024 08:00'), // Start datetime
                ],
                'duration' => '02:00'
            ],

        ];
        
        //dd($this->events);
    }

    public function addEvent($event)
    {
        $this->events = [];
        $this->events = $event;  // Add event to the array
    }
    public function render()
    {
        return view('livewire.calendar');
    }
}
