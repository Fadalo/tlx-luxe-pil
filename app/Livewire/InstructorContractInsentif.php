<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Instructor\InstructorContract;
use App\Models\Instructor\Instructor;

class InstructorContractInsentif extends Component
{
    public $instructor_contract_id = '';
    public $config = [];
    public $single_insentif_amount = 0;
    public $listMultiInsentif = [

    ];
    public $i = 0;
    public $showPrivateGroup = [
        'showPrivate' => true,
        'showGroup' => true
    ];
    public function mount()
    {
       // dd($this->instructor_contract_id);
        $InstructorContract = InstructorContract::find($this->instructor_contract_id);
        $this->doCheckContractInsentif($InstructorContract->package_id, $InstructorContract);
        
    }
    public function doAddList(){
        $data = [
            'qty'             => 0,
            'amount' => 0,
        ];
        
        $this->listMultiInsentif[$this->i] = $data;
        $this->i = $this->i+1;
    }
    public function doRemoveList($id){
        unset($this->listMultiInsentif[$id]);
    }
    public function doCheckContractInsentif($package_id,$contract){
       
        if ($package_id == 1){
            // Single
            $ins_db = json_decode($contract->insentif_rule,true);
            //dd($ins_db['single']);
            if (!empty( $ins_db )){
                $this->single_insentif_amount = $ins_db['single']['amount'];
            }
          
            $this->showPrivateGroup = [
                'showPrivate' => true,
                'showGroup' => false
            ];
        }
        else if($package_id == 2){
            $ins_db = json_decode($contract->insentif_rule,true);
            //dd($ins_db['multi']);
            if (!empty( $ins_db )){
                $this->listMultiInsentif = $ins_db['multi'];
                $this->i = count($ins_db['multi']) + 1;
            }
            $this->showPrivateGroup = [
                'showPrivate' => false,
                'showGroup' => true
            ];
        }
    }
    public function reIndex($list){
        $data = [];
        $i= 0;
        foreach($list as $key => $value){
            $data[$i] = [
                'qty' =>$value['qty'],
                'amount' =>$value['amount'],
                
            ];
            $i++;
        }
        $this->i = $i;
        $this->listMultiInsentif = $data;
        return $data;
    }
    public function doSaveMulti(){
       // dd($this->listMultiInsentif);
        $param = [
            'multi' => $this->reIndex(
                $this->listMultiInsentif)
            
        ];
        $InstructorContract = InstructorContract::find($this->instructor_contract_id);
        $InstructorContract->insentif_rule = $param;
        $InstructorContract->save();
        $this->triggerAlert( 'Berhasil Create Insentif','Berhasil di Create Insentif !!!','success');
    }
    public function doSaveSingle(){
        $param = [
            'single' => [
                'qty' => 1,
                'amount' => $this->single_insentif_amount
            ]
            ];
        $InstructorContract = InstructorContract::find($this->instructor_contract_id);
        $InstructorContract->insentif_rule = $param;
        $InstructorContract->save();
        $this->triggerAlert( 'Berhasil Create Insentif','Berhasil di Create Insentif !!!','success');
    }
    public function triggerAlert($msg,$title='Success!',$icon='success',)
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
        return view('livewire.instructor-contract-insentif');
    }
}
