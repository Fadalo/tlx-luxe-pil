<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
class FileUpload extends Component
{
    use WithFileUploads;

    public $file; // Property to hold the uploaded file
    public $showModal = true;
    public function save()
    {
        $this->showModal = true;
        // Validate the uploaded file
        $this->validate([
            'file' => 'required|file|max:1024', // 1MB Max
        ]);

        // Store the file in the "uploads" directory
        $this->file->store('uploads');

        // Optionally, you can flash a success message
        session()->flash('message', 'File successfully uploaded!');
    }

    public function doHideModal(){
        $this->showModal = false;
    }
    public function render()
    {
        return view('livewire.file-upload');
    }
}
