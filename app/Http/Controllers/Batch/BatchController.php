<?php

namespace App\Http\Controllers\Batch;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Resources\Batch\BatchResource;

use App\Http\Resources\UserResource;
use App\Models\Batch\Batch;
use App\Models\Member\Member;
use App\Models\User;
use App\Helpers\H1BHelper;

class BatchController extends Controller
{
    public  $meta = [ 
        'id'            => ['type'=> 'hidden','label'=> 'ID'],
        'name'          => ['type'=> 'text','label'=> 'Batch'],
        'remark'        => ['type'=> 'text','label'=> 'Remark'],
        'status'        => ['type'=> 'phone','label'=> 'Status'],
        'instructor_id' => ['type'=> 'select2','label'=> 'Instructor'],
        'package_id '    => ['type'=> 'select2','label'=> 'Package'],
        'start_datetime'       => ['type'=> 'datetime','label'=> 'Start Date'],
        'end_datetime'     => ['type'=> 'datetime','label'=> 'End Date'],
        'status_document' => ['type'=> 'dropdown','label'=> 'Status Document'],
        'created_at' => ['type'=> 'datetime','label'=> 'Created At'],
        'created_by' => ['type'=> 'select2','label'=> 'Created By'],
        'updated_at' => ['type'=> 'datetime','label'=> 'Updated At'],
        'updated_by' => ['type'=> 'select2','label'=> 'Updated By']
];

public $listShow = [

    'name'                => [],
    'remark'              => [],
    'status'              => [],
    'instructor_id '      => [],
    'package_id '         => [],
    'start_datetime'      => [],
    'end_datetime'        => [],
    'status_document'     => [],
    //'status_document'=>['enum'=>['draft','lock'],'enum_default'=>'draft'],
    'updated_at'=>[],
    //'updated_by'=>['related_table'=>'user','related_value'=>'name']
];

public $createShow=[
    'id'=>['width'=>'col-md-0'] ,
    'name'                => ['width'=>'col-md-4'],
    'remark'              => ['width'=>'col-md-12'],
    'status'              => ['width'=>'col-md-4'],
    'instructor_id'      => ['width'=>'col-md-4','related_table'=>'App\Models\Instructor','related_value'=>'first_name'],
    'package_id '         => ['width'=>'col-md-4','related_table'=>'App\Models\Package','related_value'=>'name'],
    'start_datetime'      => ['width'=>'col-md-4'],
    'end_datetime'        => ['width'=>'col-md-4'],
    'status_document'=>['width'=>'col-md-4','enum'=>['draft','locked'],'enum_default'=>'draft'],
];

public $detailShow=[
    'id'=>[''] ,
    'name'                => [],
    'remark'              => [],
    'status'              => [],
    'instructor_id'      => [],
    'package_id '         => [],
    'start_datetime'      => [],
    'end_datetime'        => [],
    'status_document'     => [],
    'updated_by'=>['related_table'=>'user','related_value'=>'name']
];

public function index()
{
    $batchs = Batch::all(); // Get all members
    return BatchResource::collection($batchs); // Return resource collection
}

public function create(request $request,response $response,$id=''){
    //$BatchResourse = BatchResource::collection(Batch::find($id)->get())->toArray($request);
    $data = [];
    $config = [
        'page'   => [
            'title' => 'Batch & Session - Create',
            'description' => 'Batch Create - Description',
            'name' => 'Batch & Session ',
            'parent' => 'Batch',
            'author' => 'Telcomixo',
        ],
        'module' => 'batch',
        'route'  => 'batch',
        'meta'=> H1BHelper::combine_based_on_second($this->meta,$this->createShow),
        'data' => $data,
        'relation'=>[]
    ];
    //print_r('<pre>');
    //print_r($config);
    //exit();
    return view('PanelAdmin.Batch.create',compact('config'));
}

public function detail(request $request,response $response,$id=''){
    
    $MemberResourse = MemberResource::collection(Member::find($id)->get())->toArray($request);
    $data = $MemberResourse;
    $config = [
                'page'   => [
                    'title' => 'Member Detail - ID:'.$id,
                    'description' => 'Member Detail - Description',
                    'name' => 'Detail Members: ID-'.$id,
                    'parent' => 'Members',
                    'author' => 'Telcomixo',
                ],
                'module' => 'Member',
                'route'  => 'members',
                'meta'=> $this->meta,
                'data' => $data,
                'relation'>[
                    'My Package'   => [
                        'name'=> 'My Package',
                        'module'=> 'member_order',
                        'render'=> 'PanelAdmin.component.package.inline.list',
                    ],
                    'My Scheadule' => [
                        'name'=> 'My Scheadule',
                        'module'=> 'batch',
                        'render'=> 'PanelAdmin.component.batch.inline.list',
                    ],
                    'History Pembayaran' => [
                        'name'=> 'History Pembayaran',
                        'module'=> 'member_order',
                        'render'=> 'PanelAdmin.component.member.inline.list',
                    ],
                    'Settings' => [
                        'name'=> 'Settings',
                        'module'=> 'member',
                        'render'=> 'PanelAdmin.component.m.inline.detail',
                    ],
                    
                    
                ]

            ];
    return view('PanelAdmin.Batch.detail',compact('config'));
}

public function list(request $request,response $response){

   
    $BatchResourse = BatchResource::collection(Batch::All())->toArray($request);
    $data = $BatchResourse;
    $config = [
                'page'   => [
                    'title' => 'Batch List',
                    'description' => 'Batch Listing - Description',
                    'name' => 'Listing Batch',
                    'parent' => 'Batch',
                    'author' => 'Telcomixo',
                ],
                'module' => 'batch',
                'route'  => 'batch',
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
                    'Total Batch'   => [
                        'name'=> 'Total Member',
                        'icon'=> 'ri-user-3-line font-size-24',
                        'module'=> 'member',
                        'count-value'=> '100',
                        'percentage-value'=> '20%',                            
                        'render'=> '',
                        'onClick'=> ''
                    ],
                   
                    
                ]
            ];
  
    return view('PanelAdmin.Batch.list',compact('config'));
}
}
