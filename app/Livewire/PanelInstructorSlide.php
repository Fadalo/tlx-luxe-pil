<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Instructor\Instructor;
use App\Models\Batch\Batch;
use App\Models\Batch\BatchSession;
use Illuminate\Support\Facades\Auth;

class PanelInstructorSlide extends Component
{
    public $instructor_id = '';
    public $data = [];
    public function mount(){
        $this->instructor_id = AUTH::guard('instructor')->User()->id;
        $this->data = $this->doGetData();
    }
    public function doGetData()
    {
        $BatchSession = BatchSession::join('batch','batch.id','=','batch_session.batch_id')
        ->where('instructor_id',$this->instructor_id)
        ->where('status_session','running')
        ->whereRaw('DATE(`batch_session`.`start_datetime`) > DATE(\''.date('Y-m-d').'\')')
        ->selectRaw('
          batch_session.*,
          batch.name as batch_name,
          batch.start_datetime as batch_start_datetime,
          batch.end_datetime as batch_end_datetime
          
          
          
        ')
        ->get()->toArray();
        return $BatchSession;
    }
    public function render()
    {
        return view('livewire.panel-instructor-slide');
    }
}
