<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member\Member;

class MemberSettings extends Component
{
    public $config = [];
    public $member_id = '';
    public $notification= '';
    public $promotion = '';
    public $options = [
        1 => 'Allow',
        0 => 'Disallow',
        
    ];

    public function mount()
    {
        $member = Member::find($this->member_id);
        
        $this->promotion = $member->is_news;
        $this->notification = $member->is_notify;
    }
    
    public function doToggleNotification(){
        
        $member = Member::find($this->member_id);

        if ($member)
        {
             $member->is_notify = $this->notification;
            // dd($this->notification);
             $member->save();
             $this->triggerAlert('success update notification');
        }
      
    }
    public function doTogglePromotion(){
        
        $member = Member::find($this->member_id);
        if($member){
            $member->is_news = $this->promotion;
            $member->save();
            $this->triggerAlert('success update promotion');
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
        return view('livewire.member-settings');
    }
}
