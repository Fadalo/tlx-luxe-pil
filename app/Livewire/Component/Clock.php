<?php

namespace App\Livewire\Component;

use Livewire\Component;
use Carbon\Carbon;

class Clock extends Component
{
    public $currentDateTime;

    public function mount()
    {
        $this->updateDateTime();
    }

    public function updateDateTime()
    {
        // Set the current date and time
        $this->currentDateTime = Carbon::now()->format('l, F j, Y - H:i:s'); // Example: Sunday, October 13, 2024 - 14:30:45
    }

   
    public function render()
    {
        return view('livewire.component.clock');
    }
}
