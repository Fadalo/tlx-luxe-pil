<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Package\Package;
use App\Models\Package\PackageVariant;
use App\Models\Package\PackageVariantRule;
use App\Models\Package\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class DynamicGrid extends Component
{
    public $head =  [];
    public $data = [];
    public $counterL = 0;
    public $ids = '';
    public $config = [];
    public $packageId = '';
    public $isPageShow = [
        'CreatePackageVariant' => true,
        'CreateRule'=> false,
        'DetailRule'=> false,
    ];
    public $rule=[];
    public $ruleFrom=[
        'id'=>'',
        'ddl_event'=>'',
        'ddl_apply4'=>'',
        'ddl_rule'=>''
    ]; 
    public $rule_desc= '';
    public $rulesData = [];

    public function saveData()
    {
         dd($this->data);
        // Your save logic
        session()->flash('message', 'Data saved successfully!');
    }
    public function updateField($arrayId,$packageId, $packageVariantId, $field, $value)
    {
        //print_r($packageId);
        //session()->flash('message', 'PackageId:'.$packageId.'-PackageVariantId- '.$packageVariantId);
        
        // Find the package by its ID
        $package = Package::find($packageId);

        if (!$package) {
            session()->flash('error', 'Package not found.');
            return;
        }

        // If `packageVariantId` is 'n', insert a new variant
        if ($packageVariantId == 'n') {
            $si = $package->PackageVariant()->create([
                $field => $value,
                'created_by' => Auth::User()->id,
                'updated_by' => Auth::User()->id,
            ]);  
           // dd($arrayId);
            $this->data[$arrayId][0]['source'] = 'db';
            $this->data[$arrayId][0]['value'] = $si->id;
            //dd($this->data);
            
        } else {
            // Find and update an existing package variant
            $variant = $package->PackageVariant()->find($packageVariantId);

            if ($variant) {
                $variant->update([$field => $value]);
            } else {
                session()->flash('error', 'Variant not found.');
            }
        }
    }
    public function updated(){
       // dd($this->data);
    }
    public function  increment(){
        $row = 
            [
                ['name' => 'No','type'=>'span','source'=>'n','value'=> $this->counterL ],
                ['name' => 'Name','type'=>'text','value'=> '' ],
                ['name' => 'Description','type'=>'textarea','value'=> '' ],
                ['name' => 'Qty Ticket','type'=>'number','value'=>'' ]
            ];
        $this->counterL = $this->counterL + 1;
       
        $this->data[] =$row;
    }
    public function mount(){
     
     
        
        //print_r($this->rule[0]['id']);
       // exit();
     
        $this->head = [
            ['name' => 'No','type'=>'span','width' =>'col-md-1' ],
            ['name' => 'Name','type'=>'text','width' =>'col-md-2' ],
            ['name' => 'Description','type'=>'textarea','width' =>'col-md-5' ],
            ['name' => 'Qty Ticket','type'=>'number','width' =>'col-md-2' ]
        ];
        
       
        $this->packageId = $this->config['data'][0]['id'];
       

        $package = Package::where('id',$this->packageId)->first();
        //dd( $package->id);
        //session()->flash('error',  $this->packageId);
        if($package){
            $packageVariants = $package->PackageVariant()->get();
            foreach($packageVariants as $packageKey => $packageVariant){
                
            $this->data[] =  [
                    ['name' => 'No','type'=>'span','source'=>'db', 'value'=> $packageVariant->id ],
                    ['name' => 'Name','type'=>'text','value'=> $packageVariant->name ],
                    ['name' => 'Description','type'=>'textarea','value'=> $packageVariant->desc ],
                    ['name' => 'Qty Ticket','type'=>'number','value'=>$packageVariant->package_qty_ticket ]
            ];
            }
          
        }
        else{
            
                session()->flash('error', 'Package not found.');
        }

    }
   
    public function decrease($id,$packageVariantId){
        $this->ids = $id;
    
       //print_r($id);
       //exit();
       if($packageVariantId != 'n'){
            $package = Package::find($this->packageId);
            if ($package) {
                $pp = $package->PackageVariant()->where('id',$packageVariantId)->delete();
               
            }
       }
       
       unset($this->data[$id ]);
       $this->data = array_values($this->data); 
       $this->counterL = count($this->data);
       
    }
    public function createRule($id)
    {
        $this->setActivePage('CreateRule');
        $packageVariant = PackageVariant::where('id',$id)->first();
        $this->rule=[
            'class' => 'App\Models\Package\PackageVariant',
            'id'    => $id,
            'title' =>  $packageVariant->name ,
            'ddl_rules' => Rule::all()->toArray(),
            'ddl_rules_events' => ['OnBeforeOrderSave','OnBeforeChangeOrderSave','OnBeforeCancelOrderSave'],
            'ddl_rules_apply_4' => ['New Booking','Booked'],
        ];
        //dd($id);
        //exit();
        $packageVariant = PackageVariant::find($id);
        
        $this->rulesData = $packageVariant->PackageVariantRule()->get()->toArray();
        //dd($this->rulesData->);
    }
    public function onChangeRule($id){
        if ($id != ''){
            $rule =  Rule::where('id',$id)->first();
            $this->rule_desc = $rule->remark;
        }else{
            $this->rule_desc = '';
        }
      
    }
    public function onClickSaveRule(){



        $validatedData = $this->validate([
           
            'ruleFrom.ddl_event' => 'required|string',
            'ruleFrom.ddl_rule' => 'required|integer',
            'ruleFrom.ddl_apply4' => 'required|string',
        ]);

        //dd($validatedData );

       //dd($this->ruleFrom);
       $variantId =  $this->rule['id'];
       $packageVariant = PackageVariant::find($variantId);

       $a = PackageVariantRule::where('package_variant_id',$variantId)
       ->where('events',$this->ruleFrom['ddl_event'])
       ->where('rule_id',$this->ruleFrom['ddl_rule'])
       ->where('apply4',$this->ruleFrom['ddl_apply4'])
       ->get();

       //dd(count($a->items));
      

       if($a->isEmpty()){
    
       $packageVariantRule = $packageVariant->PackageVariantRule()->create(
            [
                'package_variant_id'=> $variantId,
                'events'=> $this->ruleFrom['ddl_event'],
                'rule_id'=> $this->ruleFrom['ddl_rule'],
                'apply4'=> $this->ruleFrom['ddl_apply4'],
                'status_document'=> 'draft',
                'created_by'=> Auth::User()->id,
                'updated_by'=> Auth::User()->id
                
            ]
            );
            $varianRuleId = $packageVariantRule->id;
            //dd($a);
            $this->triggerAlert('Rule Sudah Berhasil Disimpan','Success !!!','success');
       }
       else{
        $this->triggerAlert('Rule Sudah Pernah Di isi silahkan pilih yang lain','Peringatan !!!','info');
       }

       $this->rulesData = PackageVariantRule::where('package_variant_id',$variantId)->get()->toArray();
        
        

    }
    public function onDeleteRule($id){
        //dd($id);
        
        PackageVariantRule::where('id',$id)->delete();
        $variantId =  $this->rule['id'];
        $this->rulesData = PackageVariantRule::where('package_variant_id',$variantId)->get()->toArray();
        $this->triggerAlert('Rule Berhasil di hapus','Berhasil di hapus !!!','success');
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
    public function detailRule($id)
    {
        $this->setActivePage('DetailRule');

    }
    public function createVariant(){

        $this->setActivePage('CreatePackageVariant');
        //dd($this->isPageShow);
    }
    public function setActivePage($page){
        foreach( $this->isPageShow as $key => $value)
       {
            if ($key == $page)
            {
                $this->isPageShow[$key] = true;
            }
            else{
                $this->isPageShow[$key] = false;
            }
       }
    }
    public function render()
    {
        return view('livewire.dynamic-grid');
    }
}
