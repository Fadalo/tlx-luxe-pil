<?php

namespace App\Livewire;

use Livewire\Component;

class BatchScheduleSession extends Component
{
    public $BatchSessionId = '';
    public $data = [];
    public $ViewBatchSession = [
        'viewCreate' => 'false',
        'viewList' => 'true'
    ];
    
    public function render()
    {
        return view('livewire.batch-schedule-session');
    }
}
