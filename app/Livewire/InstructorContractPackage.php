<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Instructor\InstructorContract;
use Illuminate\Support\Facades\Auth;

class InstructorContractPackage extends Component
{
    
    public $instructorContractPackages;
    public $config = [];
    public $instructor_id = '';
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
       // dd($this->instructor_id);
        $this->instructorContractPackages = InstructorContract::where('instructor_id',$this->instructor_id)->get();
    }

    public function render()
    {
        return view('livewire.instructor-contract');
    }

   

    public function edit($id)
    {
      //  dd('s1');
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

        $this->dispatch('InstructorContract:createClick',['instructor_id' => $id]);

    }

    public function delete($id)
    {
        dd('s3');
        InstructorContract::find($id)->delete();
        session()->flash('message', 'Instructor Package Deleted Successfully.');
        $this->instructorContractPackages = InstructorContract::all();
    }

    public function doContractUpdate()
    {
        try{
            $this->validate([
                'form.name' => 'required',
                'form.package_id' => 'required',
        
                'form.contract_start_date' => 'required',
                'form.contract_end_date' => 'required',
              
            ]);
          
            $instructorPackage = InstructorContract::find($this->selectedId);
            //dd($instructorPackage );
            $instructorPackage->update([
                'name' => $this->form['name'],
                'instructor_id' => $this->instructor_id,
                'package_id' => $this->form['package_id'],
                'contract_activated_date' => $this->form['contract_activated_date'],
                'contract_start_date' => $this->form['contract_start_date'],
                'contract_end_date' => $this->form['contract_end_date'],
                'remark' => $this->form['remark'],
                'status_document' => $this->form['status_document'],
                'updated_by' => AUTH::user()->id
    
            ]);
           
         
            $this->resetFields();
            $this->instructorContractPackages = InstructorContract::where('instructor_id',$this->instructor_id)->get();
            
            $this->triggerAlert('Instructor Contract Updated Successfully.');
            //exit();
           
        }
        catch(Exception $e){

            //$this->triggerAlert('Please Check Your Data','Error !!!','error');
        }
       
    }
    public function doContractSave(){
       
        try {
            $a = $this->validate([
                'form.name' => 'required',
                'form.package_id' => 'required',
                'form.contract_start_date' => 'required',
                'form.contract_end_date' => 'required',
            ]);
            $instructorPackage = new InstructorContract;
            $instructorPackage->name = $a['form']['name'];
            $instructorPackage->instructor_id = $this->instructor_id;
            $instructorPackage->package_id =  $a['form']['package_id'];
            $instructorPackage->contract_start_date =  $a['form']['contract_start_date'];
            $instructorPackage->contract_end_date =  $a['form']['contract_end_date'];
            $instructorPackage->remark =  $this->form['remark'];
            $instructorPackage->status_document =  $this->form['status_document'];
            $instructorPackage->created_by = AUTH::user()->id;
            $instructorPackage->updated_by = AUTH::user()->id;
            
            
            $instructorPackage->save();
            $this->triggerAlert('Instructor Contract Created Successfully.');
           
        } catch (Exception $e) {
            $this->triggerAlert('Please Check Your Data','Error !!!','error');

        }
        

        
    }
    public function back2List(){

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

/*
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
        public function update()
    {
        try{
            $this->validate([
                'form.name' => 'required',
                'form.package_id' => 'required',
        
                'form.contract_start_date' => 'required',
                'form.contract_end_date' => 'required',
              
            ]);
          
            $instructorPackage = InstructorContract::find($this->selectedId);
            //dd($instructorPackage );
            $instructorPackage->update([
                'name' => $this->form['name'],
                'instructor_id' => $this->instructor_id,
                'package_id' => $this->form['package_id'],
                'contract_activated_date' => $this->form['contract_activated_date'],
                'contract_start_date' => $this->form['contract_start_date'],
                'contract_end_date' => $this->form['contract_end_date'],
                'remark' => $this->form['remark'],
                'status_document' => $this->form['status_document'],
                'updated_by' => AUTH::user()->id
    
            ]);
           
         
            $this->resetFields();
            $this->instructorContractPackages = InstructorContract::where('instructor_id',$this->instructor_id)->get();
            
            $this->triggerAlert('Instructor Contract Updated Successfully.');
            //exit();
           
        }
        catch(Exception $e){

            $this->triggerAlert('Please Check Your Data','Error !!!','error');
        }
        
    }
*/