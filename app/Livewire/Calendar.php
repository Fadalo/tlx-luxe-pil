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
        $this->addEvent($newEvent);
        $contract = InstructorContract::where('instructor_id',$this->instructor_id)->get()->toArray();
         // dd($this->instructor_id);
        $this->generateEvent( $contract );
        $this->dispatch('refreshCalendar',['event1'=>json_encode($this->events)]);
        //dd($this->events);
    }
    public function updateCalendar()
    {
         // Load initial events (You can fetch from DB)
         $contract = InstructorContract::where('instructor_id',$this->instructor_id)->get()->toArray();
         // dd($this->instructor_id);
          $this->generateEvent( $contract );
    }
    public function mount()
    {
        // Load initial events (You can fetch from DB)
        $contract = InstructorContract::where('instructor_id',$this->instructor_id)->get()->toArray();
       // dd($this->instructor_id);
        $this->generateEvent( $contract );
       

        /*
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

        ];*/
        
        //dd($this->events);
    }

    public function generateEvent( $contract ){

        $event = [];
        $i=0;
        foreach($contract as $kc => $vc){
            if (!empty($vc['schedule_instructor'])){
                $sch = json_decode($vc['schedule_instructor'],true);
                // dd($sch);
                   foreach ($sch as $key => $value){
                       foreach($value['days'] as $keyDay => $valueDay){
                           foreach ($valueDay['time_ranges'] as $keyTime =>$valueTime){
                          
       
                               $dStart = $vc['contract_start_date'];
                               $dEnd   = $vc['contract_end_date'];
                               $dStartTime = $valueTime['start'];
                               $dEndTime   = $valueTime['end'];
                               
                               $dStartCombine = date('d/m/Y H:i',strtotime($dStart.' '.$dStartTime));
                               $dEndCombine   = date('d/m/Y H:i', strtotime($dStart.' '.$dEndTime));
                               
                               $start = Carbon::createFromFormat('d/m/Y H:i', $dStartCombine );
                               $end = Carbon::createFromFormat('d/m/Y H:i',  $dEndCombine  );
       
                               // Get the difference in hours and minutes
                               $diffInHours = $start->diffInHours($end); // Whole hours
                               $diffInMinutes = $start->diffInMinutes($end) % 60; // Remaining minutes after full hours
       
                               // Format the duration as "HH:mm"
                               $duration = sprintf('%02d:%02d', $diffInHours, $diffInMinutes);
                               //dd($duration);
                               
                               $days  = $valueDay['name'];
                               $event[$i++] = [
                                   'title'=> $vc['name'],
                                   'description' => 'Hello',
                                   'ssss'=>'sasdasdsa',
                                   'rrule'=> [
                                       
                                       'freq'=> 'weekly',           // Weekly recurrence
                                       'byweekday'=> $days,  // Monday, Tuesday, Friday
                                       'dtstart'=> Carbon::createFromFormat('d/m/Y H:i', $dStartCombine), // Start datetime
                                   ],
                                   'duration' => $duration,
                               ];
                           
                           }
                       }
                   }
            }
         
        }
        //dd($event);
        $this->events = $event;
    }

    public function setCalendar($value){
       // $this->events = [];
        
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
