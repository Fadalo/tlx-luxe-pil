<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class CountdownTimer extends Component
{
   /* public function render()
    {
        return view('livewire.countdown-timer');
    }
*/
    public $targetTime;
    public $remainingTime;
    public $currentTime;
    public $diffInMonths;
    public $diffInDays;
    public $diffInHours;
    public $diffInMinutes;
    public $diffInSeconds;
    
    
    


    public function mount($targetTime)
    {
        $this->targetTime = Carbon::parse($targetTime);
        $this->updateRemainingTime();
    }

    public function updateRemainingTime()
    {
        $now = Carbon::now();
        $this->currentTime = $now;
        $diff = $this->targetTime->diff($now);
        

        $diffInDays = $now->diff($this->targetTime);
        $diffInHours = $now->copy()->addDays($diffInDays)->diffInHours($this->targetTime);
        $diffInMinutes = $now->copy()->addDays($diffInDays)->addHours($diffInHours)->diffInMinutes($this->targetTime);
        $diffInSeconds = $now->copy()->addDays($diffInDays)->addHours($diffInHours)->addMinutes($diffInMinutes)->diffInSeconds($this->targetTime);



        /*
        $this->remainingTime = sprintf(
            '%02d days %02d hours %02d minutes %02d seconds', 
            $diff->d,  // Difference in days
            $diff->h,  // Difference in hours
            $diff->i,  // Difference in minutes
            $diff->s   // Difference in seconds
        );
        */
        $this->remainingTime = "Difference: $diff->m months- $diff->d days |$diff->h : $diff->i : $diff->s    ";
    }

    public function render()
    {
        $this->updateRemainingTime();
        return view('livewire.countdown-timer');
    }
}
