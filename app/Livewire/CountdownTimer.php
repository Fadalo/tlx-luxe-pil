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
    public $format;
    public $id;
    public $prefix;
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
        if($this->remainingTime != 'Expired'){
        $now = Carbon::now();
        $this->currentTime = $now;
        $diff = $this->targetTime->diff($now);
        

        $diffInDays = $now->diffInDays($this->targetTime);
        $diffInHours = $now->diffInHours($this->targetTime);
        $diffInMinutes = $now->diffInMinutes($this->targetTime);
        $diffInSeconds = $now->diffInSeconds($this->targetTime);



        /*
        $this->remainingTime = sprintf(
            '%02d days %02d hours %02d minutes %02d seconds', 
            $diff->d,  // Difference in days
            $diff->h,  // Difference in hours
            $diff->i,  // Difference in minutes
            $diff->s   // Difference in seconds
        );
        */
        switch($this->format)
        {
            case 'days':
                     $this->remainingTime = sprintf(
    $this->prefix." %d days",
    round($diffInDays)
);
                break;
            case 'hours':
                    $this->remainingTime = rounded($diffInHours);
                break;
            default:
                    if ($diff->m == 0 && $diff->d == 0 && $diff->h == 0 && $diff->i == 0 && $diff->s == 0) {
                        $this->remainingTime = "Expired";
                    } elseif ($diff->m == 0 && $diff->d > 0) {
                        $this->remainingTime = sprintf(
                            "%s %d days %02d:%02d:%02d", 
                            $this->prefix, 
                            round($diff->d), 
                            round($diff->h), 
                            round($diff->i), 
                            round($diff->s)
                        );
                        
                    } elseif ($diff->m == 0 && $diff->d == 0 && $diff->h > 0) {
                        $this->remainingTime = $this->prefix."$diff->h : $diff->i : $diff->s";
                    } elseif ($diff->m == 0 && $diff->d == 0 && $diff->h == 0) {
                        $this->remainingTime = $this->prefix."$diff->i : $diff->s";
                    } else {
                        $this->remainingTime = $this->prefix." $diff->m months - $diff->d days $diff->h:$diff->i:$diff->s";
                    }
                break;
        }
        
        
    }

       
    }

    public function render()
    {
        
        $this->updateRemainingTime();
        return view('livewire.countdown-timer');
    }
}
