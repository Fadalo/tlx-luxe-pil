<?php

namespace App\Livewire;

use Livewire\Component;

class ScheduleChangeInstructorNew extends Component
{
    public $batch_session_id = '';
    
    public function render()
    {
        return view('livewire.schedule-change-instructor-new');
    }
}
