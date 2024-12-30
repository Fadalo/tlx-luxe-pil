<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class ComponentCalendar extends Component
{
    public $month;
    public $year;
    public $events = [];
    public $selectedDate = '30-12-2024';
    public $cc='';

    public function mount()
    {
        $this->month = date('m');
        $this->year = date('Y');
    }

    
    public function getEventsForDate($date)
    {
          $this->selectedDate = $date;
          $this->events = Event::whereDate('start_time', $date)->get();
    }
    public function doNext(){
        $this->month = $this->month + 1;
        $this->render();
    }
    public function doPrev(){
        $this->month = $this->month - 1;
        $this->render();
    }
    public function render()
    {
        $date =  Carbon::createFromDate($this->year, $this->month);
        $startOfCalendar = $date->copy()->firstOfMonth()->startOfWeek(Carbon::SUNDAY);
        $endOfCalendar = $date->copy()->lastOfMonth()->endOfWeek(Carbon::SATURDAY);

       
        while($startOfCalendar <= $endOfCalendar)
        {
            $extraClass = $startOfCalendar->format('m') != $date->format('m') ? 'cal-disabled' : '';
            $extraClass .= $startOfCalendar->isToday() ? 'cal-selected' : '';
            $today = $startOfCalendar->isToday() ? true : false;

            $days[] = 
            [
                'day' => $startOfCalendar->format('j') ,
                'date' => $startOfCalendar->format('Y-m-d'),
                'extraClass' =>$extraClass,
                'today' => $today 
            ];
            $startOfCalendar->addDay();
        }
        $calendar[] = $days;
        return view('livewire.component-calendar', [
            'calendar' => $calendar,
            'selectedDate' => $this->selectedDate,
            'events' => $this->events,
        ]);
    }
   
}


