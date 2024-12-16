<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Instructor\InstructorContract;
use App\Models\Package\Package;
use App\Models\Package\PackageVariant;



use Carbon\Carbon;

class ScheduleInput extends Component
{
    public $schedules = [];
    public $list_weekday = [
        'MO'=> 'Monday',
        'TU'=> 'Tuesday',
        'WE'=> 'Wednesday',
        'TH'=> 'Thursday',
        'FR'=> 'Friday',
        'ST'=> 'Saturday',
        'SU'=> 'Sunday'
    ];
    public $instructor_id = '';
    public $contract_id = '';
    public $config = [];
   
    public $iCountDay = 0;

    public function mount()
    {
        $contract = InstructorContract::find($this->contract_id);
        if(!empty($contract->schedule_instructor)){
            $this->schedules = json_decode($contract->schedule_instructor,true);
        }else{
            $this->addWeek();
        }
        // Initialize with one week and one day
       
    }

    public function addWeek()
    {
        $this->schedules[] = [
            'days' => [
                ['name' => 'MO', 'time_ranges' => [['start' => '', 'end' => '']]],
            ],
        ];
    }

    public function addDay($weekIndex)
    {
        if ($this->iCountDay < 6)
        {
            $this->schedules[$weekIndex]['days'][] = [
                'name' => '',
                'time_ranges' => [['start' => '', 'end' => '']],
            ];
            $this->iCountDay++;
        }
       
    }

    public function addTimeRange($weekIndex, $dayIndex)
    {
        $this->schedules[$weekIndex]['days'][$dayIndex]['time_ranges'][] = ['start' => '', 'end' => ''];
    }

    public function removeTimeRange($weekIndex, $dayIndex, $rangeIndex)
    {
        unset($this->schedules[$weekIndex]['days'][$dayIndex]['time_ranges'][$rangeIndex]);
    }

    public function triggerAlert($msg,$title='Success!',$icon='success')
    {
        // Emit event to frontend to trigger SweetAlert
        $this->dispatch('swal:alert', [
            'icon' => $icon,
            'title' => $title,
            'text' => $msg,
        ]);
    }
    public function render()
    {
        return view('livewire.schedule-input');
    }

    public function submit()
    {

       try{

         // Example: Save or process the schedule data
         $instructorContract = InstructorContract::find($this->contract_id);
         $instructorContract->schedule_instructor = $this->schedules;
         $instructorContract->save();
 
         $this->triggerAlert('Instructor Schedule Saved');
         $this->loadEvent();
       }
       catch(Extension $e){
           $this->triggerAlert($e->getMessage(), 'Error!', 'error');
       }
       
       
    }

    public function loadEvent(){
       
        $contract = InstructorContract::find($this->contract_id);
        
        $event = [];
        foreach ($this->schedules as $key => $value){
            foreach($value['days'] as $keyDay => $valueDay){
                foreach ($valueDay['time_ranges'] as $keyTime =>$valueTime){
                   

                    $dStart = $contract->contract_start_date;
                    $dEnd   = $contract->contract_end_date;
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
                    $event[] = [
                        'title'=> 'Recurring Event',
                        'description' => 'Hello',
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

        $this->dispatch('updateDataCalendar',['event'=>$event]);
        
    }
}
