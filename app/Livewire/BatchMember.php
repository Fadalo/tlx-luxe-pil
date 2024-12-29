<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Batch\Batch;
use App\Models\Batch\BatchSession;
use App\Models\Member\MemberPackageOrder;
use App\Models\Member\Member;

class BatchMember extends Component
{
    public $config = [];
    public $batch_id = '';
    public $listMember  = [];
    
    public function mount(){
        
        $MemberPackageOrder = MemberPackageOrder::select('member_id')->where('batch_id',$this->batch_id)->groupBy('member_id')->get();
        $list = [];
        foreach($MemberPackageOrder as $k => $v){

            $Member = Member::find($v->member_id);
            $list[] = [
                'id' => $Member->id,
                'first_name' => $Member->first_name,
                'last_name' => $Member->last_name,
                'phone_no' => $Member->phone_no,
            ];
        }
        $this->listMember = $list;
    }
    public function render()
    {
        return view('livewire.batch-member');
    }
}
