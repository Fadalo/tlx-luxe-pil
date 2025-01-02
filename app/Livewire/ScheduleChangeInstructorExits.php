<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Instructor\Instructor;

class ScheduleChangeInstructorExits extends Component
{
    public $listInstructor = [];
    public function mount(){
        $this->listInstructor = Instructor::All()->toArray();
    }
    public function render()
    {
        return view('livewire.schedule-change-instructor-exits');
    }
}
