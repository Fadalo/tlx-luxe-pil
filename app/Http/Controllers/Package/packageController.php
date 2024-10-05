<?php

namespace App\Http\Controllers\Package;

use Illuminate\Http\Request;
use Illuminate\Http\Response; 
use App\Http\Controllers\Controller; 
       

use App\Http\Resources\Package\PackageResource;
use App\Http\Resources\UserResource;
use App\Models\Package\Package;
use App\Models\User;
use App\Helpers\H1BHelper;


class packageController extends Controller
{
    public  $meta = [ 
        'id'        => ['type'=> 'text'],
        'name'      => ['type'=> 'text'],
        'desc'      => ['type'=> 'textarea'],
        'status_document' => ['type'=> 'dropdown'],
        'created_at' => ['type'=> 'datetime'],
        'created_by' => ['type'=> 'select2'],
        'updated_at' => ['type'=> 'datetime'],
        'updated_by' => ['type'=> 'select2']
    ];

    public $listShow = [
        'name'=>[], 
        'desc'=>[], 
        //'status_document'=>['enum'=>['draft','lock'],'enum_default'=>'draft'],
        'updated_at'=>[],
        //'updated_by'=>['related_table'=>'user','related_value'=>'name']
    ] ;

    public $createShow=[
        'id'=>[] ,
        'name'=>[], 
        'desc'=>[] , 
        'status_document'=>['enum'=>['draft','lock'],'enum_default'=>'draft'],
    ];

    public $detailShow=[
        'id' ,
        'name'=>[], 
        'desc'=>[] , 
        'status_document'=>['enum'=>['draft','lock'],'enum_default'=>'draft'],
        'created_at',
        'created_by'=>['related_table'=>'user','related_value'=>'name'],
        'updated_at',
        'updated_by'=>['related_table'=>'user','related_value'=>'name']
    ];
   
    public function index()
    {
        $packages = Package::all(); // Get all members
        return PackageResource::collection($packages); // Return resource collection
    }
    
    public function create(request $request,response $response){
        return view('PanelAdmin.Package.create');
    }

    public function detail(request $request,response $response){
        return view('PanelAdmin.Package.create');
    }
    
    public function list(request $request,response $response){

        $PackageResource = PackageResource::collection(Package::All())->toArray($request);
        $data = $PackageResource;
        $config = [
                    'page'   => [
                        'title' => 'Package List',
                        'description' => 'Package Listing - Description',
                        'name' => 'Listing Package',
                        'parent' => 'Package',
                        'author' => 'Telcomixo',
                    ],
                    'module' => 'package',
                    'route'  => 'package',
                    'meta'=> H1BHelper::combine_based_on_second($this->meta,$this->listShow),
                    'data' => $data,
                    'register_callback',
                    'button'=>[
                        'Export Excel'=>[
                            'name'=>'Export Excel',
                            'route'=>'members/create',
                            'icon'=>'ri-add-line'
                        ],
                        'Export PDF'=>[
                            'name'=>'Export Excel',
                            'route'=>'members/create',
                            'icon'=>'ri-add-line'
                        ],
                    ],
                    
                    'stat'=>[
                        'Total Instructor'   => [
                            'name'=> 'Total Package',
                            'icon'=> 'ri-user-3-line font-size-24',
                            'module'=> 'instructor',
                            'count-value'=> '100',
                            'percentage-value'=> '20%',                            
                            'render'=> '',
                            'onClick'=> ''
                        ],
                       
                       
                        
                    ]
                ];
      
        return view('PanelAdmin.Package.list',compact('config'));
    }
}
