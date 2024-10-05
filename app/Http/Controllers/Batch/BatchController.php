<?php

namespace App\Http\Controllers\Batch;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public  $meta = [ 
        'id'           => ['type'=> 'text'],
        'name'         => ['type'=> 'text'],
        'remark'       => ['type'=> 'text'],
        'status'       => ['type'=> 'phone'],
        'instructor_id '        => ['type'=> 'select2'],
        'package_id '             => ['type'=> 'select2'],
        'start_datetime'       => ['type'=> 'datetime'],
        'end_datetime'     => ['type'=> 'datetime'],
        'status_document' => ['type'=> 'dropdown'],
        'created_at' => ['type'=> 'datetime'],
        'created_by' => ['type'=> 'select2'],
        'updated_at' => ['type'=> 'datetime'],
        'updated_by' => ['type'=> 'select2']
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
    'id'=>[] ,
    'name'                => [],
    'remark'              => [],
    'status'              => [],
    'instructor_id '      => [],
    'package_id '         => [],
    'start_datetime'      => [],
    'end_datetime'        => [],
    'status_document'=>['enum'=>['draft','lock'],'enum_default'=>'draft'],
];

public $detailShow=[
    'id'=>[] ,
    'name'                => [],
    'remark'              => [],
    'status'              => [],
    'instructor_id '      => [],
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

public function create(request $request,response $response){
    $BatchResourse = BatchResource::collection(Batch::find($id)->get())->toArray($request);
    $data = $BatchResourse;
    $config = [
                'page'   => [
                    'title' => 'Batch Detail - ID:'.$id,
                    'description' => 'Batch Detail - Description',
                    'name' => 'Detail Batch: ID-'.$id,
                    'parent' => 'Batch',
                    'author' => 'Telcomixo',
                ],
                'module' => 'Batch',
                'obj'=> new Batch,
                'route'  => 'batch',
                'meta'=> $this->meta,
                'data' => $data,

            ];
    return view('PanelAdmin.Batch.create',compact('config'));
}

public function detail(request $request,response $response,$id){
    
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
