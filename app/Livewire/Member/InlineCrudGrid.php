<?php

namespace App\Livewire;

use App\Models\Member\Member;
use Livewire\Component;

class InlineCrudGrid extends Component
{
   
    public $member = [];
    public $first_name, $last_name, $member_id;
    public $isModalOpen = 0;

   

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    private function resetInputFields()
    {
        $this->first_name = '';
        $this->last_name = '';
        
    }

    public function store()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        Member::updateOrCreate(['id' => $this->member_id], [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone_no' => '+62888888',
            'pin' => '1234',
            'status_document' => 'draft',
            
        ]);

        session()->flash('message',
            $this->member_id ? 'Member Updated Successfully.' : 'Member Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);
        $this->id = $id;
        $this->first_name = $member->first_name;
        $this->last_name = $member->last_name;
        
        

        $this->openModal();
    }

    public function delete($id)
    {
        Member::find($id)->delete();
        session()->flash('message', 'Member Deleted Successfully.');
    }
   
    public function render()
    {
        $this->member = Member::All();
        return view('livewire.inline-grid-create');
    }
    
}

