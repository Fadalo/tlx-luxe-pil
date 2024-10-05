<?php

namespace App\Livewire\Component\GridWithCrud;

use App\Models\Member\Member;
use Livewire\Component;

class InlineGridCreate extends Component
{
   
    public $member = [];
    public $first_name, $last_name, $phone_no, $member_id;
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
        $this->phone_no = '';
        
        
    }

    public function store()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_no' => 'required'
        ]);

        Member::updateOrCreate(['id' => $this->member_id], [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone_no' => $this->phone_no,
            'pin' => '1234',
            'status_document' =>'draft',
        ]);

        session()->flash('message',
            $this->member_id ? 'Member Updated Successfully.' : 'Member Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit_grid($id)
    {
        //$this->closeModal();
       // $this->openModal();
      // $this->create();
        $member = Member::findOrFail($id);
        $this->id = $id;
        $this->first_name = $member->first_name;
        $this->last_name = $member->last_name;
        $this->phone_no = $member->phone_no;
        //print_r($member);
        //exit();
        $this->isModalOpen = true;
       // $this->openModal();
        
    }

    public function delete_grid($id)
    {
        Member::find($id)->delete();
        session()->flash('message', 'Member Deleted Successfully.');
    }
   
    public function render()
    {
        $this->member = Member::All();
       // echo 'sss';
        return view('livewire.Component.grid-with-crud.inline-grid-create');
    }
    
}

