<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Instructor\InstructorContract;

class InstructorContractPackage extends Component
{
    
    public $instructorContractPackages;
    public $form = [
            'name'=> '',
            'instructor_id' => '',
            'package_id' => '',
            'contract_activated_date' => '',
            'contract_start_date' => '',
            'contract_end_date' => '',
            'remark' => '',
            'status_document'=> ''
            
    ];
    public $isEditMode = false, $selectedId;

    public function mount()
    {
        $this->instructorContractPackages = InstructorContract::all();
    }

    public function render()
    {
        return view('livewire.instructor-contract');
    }

    public function store()
    {
        $this->validate([
            'form.name' => 'required|string', // assuming you have an instructor table
            'form.instructor_id' => 'required|exists:instructor,id', // assuming you have an instructor table
            'form.package_id' => 'required|exists:package,id', // assuming you have a package table
            'form.contract_activated_date' => 'required|date',
            'form.contract_start_date' => 'required|date',
            'form.contract_end_date' => 'required|date',
            'form.remark' => 'nullable|string',
            'form.status_document' => 'required|in:draft,locked',
        ]);

       
        InstructorContract::create([
            'name'=> $this->form['name'],
            'instructor_id' => $this->form['instructor_id'],
            'package_id' => $this->form['package_id'],
            'contract_activated_date' => $this->form['contract_activated_date'],
            'contract_start_date' => $this->form['contract_start_date'],
            'contract_end_date' => $this->form['contract_end_date'],
            'remark' => $this->form['remark'],
            'status_document' => $this->form['status_document'],
        ]);

        session()->flash('message', 'Instructor Package Created Successfully.');
        $this->resetFields();
        $this->instructorContractPackages = InstructorContract::all();
    }

    public function edit($id)
    {
        dd('s1');
        $this->isEditMode = true;
        $instructorPackage = InstructorContract::find($id);
        $this->selectedId = $id;
        $this->form['name'] = $instructorPackage->name;
        $this->form['instructor_id'] = $instructorPackage->instructor_id;
        $this->form['package_id'] = $instructorPackage->package_id;
        $this->form['contract_activated_date'] = $instructorPackage->contract_activated_date;
        $this->form['contract_start_date'] = $instructorPackage->contract_start_date;
        $this->form['contract_end_date'] = $instructorPackage->contract_end_date;
        $this->form['remark'] = $instructorPackage->remark;
        $this->form['status_document'] = $instructorPackage->status_document;
    }

    public function update()
    {
        $this->validate([
            'form.name' => 'required|strings',
            
            'form.instructor_id' => 'required|exists:instructors,id',
            'form.package_id' => 'required|exists:packages,id',
            'form.contract_activated_date' => 'required|date',
            'form.contract_start_date' => 'required|date',
            'form.contract_end_date' => 'required|date',
            'form.remark' => 'nullable|string',
            'form.status_document' => 'required|in:draft,locked',
        ]);

        $instructorPackage = InstructorContract::find($this->selectedId);
        $instructorPackage->update([
            'name' => $this->form['name'],
            'instructor_id' => $this->form['instructor_id'],
            'package_id' => $this->form['package_id'],
            'contract_activated_date' => $this->form['contract_activated_date'],
            'contract_start_date' => $this->form['contract_start_date'],
            'contract_end_date' => $this->form['contract_end_date'],
            'remark' => $this->form['remark'],
            'status_document' => $this->form['status_document'],
        ]);

        session()->flash('message', 'Instructor Package Updated Successfully.');
        $this->resetFields();
        $this->instructorContractPackages = InstructorContract::all();
    }

    public function delete($id)
    {
        dd('s3');
        InstructorContract::find($id)->delete();
        session()->flash('message', 'Instructor Package Deleted Successfully.');
        $this->instructorContractPackages = InstructorContract::all();
    }

    private function resetFields()
    {
        $this->form['name'] = '';
        $this->form['instructor_id'] = '';
        $this->form['package_id'] = '';
        $this->form['contract_activated_date'] = '';
        $this->form['contract_start_date'] = '';
        $this->form['contract_end_date'] = '';
        $this->form['remark'] = '';
        $this->form['status_document'] = '';
        $this->isEditMode = false;
        $this->selectedId = null;
    }
}
