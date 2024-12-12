<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class WaQrCode extends Component
{
    public $qrData = '';
    public $loading = false;
    public $error = null;
    public $status= 'offline';
    public $i = 0;
    public function mount()
    {
       
        $this->checkStatus();
        $this->fetchQrCode();
       
    }

    public function updateP()
    {
        $this->i++;
        //print_r
        $this->checkStatus();
        $this->fetchQrCode();
    }
    public function checkStatus(){
        try {
            $this->loading = true;
            $this->error = null;

            $response = Http::get(env('WA_API').'/status');
            
            if ($response->successful()) {
                $data = $response->json();
                //print_r($data);
                //exit();
                if($data['isReady']=='true')
                {
                    $this->status = 'online';
                }
                else{
                    //print_r($data['isReady']);
                    //exit();
                    $this->status = 'offline';
                } 
            } else {
                $this->error = 'Failed to Check Status';
            }
        } catch (\Exception $e) {
            $this->error = 'Error: ' . $e->getMessage();
        } finally {
           $this->status = $this->status ;
        }
    }
    public function logout(){
        try {
            $this->loading = true;
            $this->error = null;

            $response = Http::get(env('WA_API').'/logout');
            
            if ($response->successful()) {
                $data = $response->json();
                if($data['success'] == true){
                    $this->status = 'offline';
                }
                
            } else {
                $this->error = 'Failed to logout';
            }
        } catch (\Exception $e) {
            $this->error = 'Error: ' . $e->getMessage();
        } finally {
            $this->loading = false;
        }
    }
    public function fetchQrCode()
    {
        try {
            $this->loading = true;
            $this->error = null;

            $response = Http::get(env('WA_API').'/qr');
            
            if ($response->successful()) {
                $data = $response->json();
                if ($this->qrData != $data['qr'])
                {
                    $this->i = 0;
                }
                $this->qrData = $data['qr'];
            } else {
                $this->error = 'Failed to fetch QR code';
            }
        } catch (\Exception $e) {
            $this->error = 'Error: ' . $e->getMessage();
        } finally {
            $this->loading = false;
        }
    }

    public function render()
    {
        $this-> updateP();
        return view('PanelAdmin.component.qr.wa', [
            'qrData' => $this->qrData,
            'loading' => $this->loading,
            'error' => $this->error,
            'i'=>$this->i
        ]);
    }
}