<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Instructor\Instructor;

class InstructorSettings extends Component
{
    public $config = [];
    public $instructor_id = '';
    public $notification= '';
    public $AllowDisabled = '';
    public $options = [
        1 => 'Allow',
        0 => 'Disallow',
        
    ];
    public $optionsAllowDisabled = [
        1=> 'Actived',
        0=> 'Not Actived'
    ];

    public function mount()
    {
        $instructor = Instructor::find($this->instructor_id);
       // dd($this->instructor_id);
        $this->notification = $instructor->is_notify;
        $this->AllowDisabled = $instructor->status_instructor;
    }
    
    public function doToggleNotification(){
        
        $instructor = Instructor::find($this->instructor_id);

        if ($instructor)
        {
             $instructor->is_notify = $this->notification;
            // dd($this->notification);
             $instructor->save();
             $this->triggerAlert('success update notification');
        }
      
    }
    public function doToggleAllowDisabled (){
        $instructor = Instructor::find($this->instructor_id);

        if ($instructor)
        {
             $instructor->status_instructor = $this->AllowDisabled ;
;
            // dd($this->notification);
             $instructor->save();
             $this->triggerAlert('success update ');
        }
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
        return view('livewire.instructor-settings');
    }
}
