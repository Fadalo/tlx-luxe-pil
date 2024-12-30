<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Instructor\Instructor;
use App\Models\Instructor\InstructorInsentif;
use App\Models\Batch\Batch;
use App\Models\Batch\BatchSession;

use Illuminate\Support\Facades\Auth;

class PanelInstructorComponentInsentif extends Component
{
    public $instructor_id = '';
    public $totalInsentif = 0.00;
    public $formateInsentif ='';
    public $data = [];
    public function mount()
    {
        $this->instructor_id = Auth::guard('instructor')->User()->id;
        $this->data = $this->getData();
        $this->doCalculateTotal();
        $this->formateInsentif = $this->getTotalInsentif();
    }
    public function doCalculateTotal(){
        foreach($this->data as $key=>$value){
            $this->totalInsentif = $this->totalInsentif + $value['amount'];
        }
    }
    public  function getTotalInsentif(){
        return 'Rp. '.number_format($this->totalInsentif,2,'.',',');
    }
    public function getData()
    {
        $InstructorInsentif = InstructorInsentif::where('instructor_id',$this->instructor_id)->get()->toArray();
        if($InstructorInsentif)
        {
            return $InstructorInsentif;
        }
        else
        {
            return [];
        }
       
    }
    public function render()
    {
        return view('livewire.panel-instructor-component-insentif');
    }
}
