<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;         
use Illuminate\Http\Response; 
use App\Http\Resources\Member\MemberResource;

use App\Http\Resources\UserResource;
use App\Models\Member\Member;
use App\Models\User;
use App\Helpers\H1BHelper;



class MemberController extends Controller
{
    
    public  $meta = [ 
            'id'              => ['type'=> 'text'],
            'first_name'      => ['type'=> 'text'],
            'last_name'       => ['type'=> 'text'],
            'phone_no'        => ['type'=> 'phone'],
            'birthday'        => ['type'=> 'date'],
            'pin'             => ['type'=> 'password'],
            'join_date'       => ['type'=> 'datetime'],
            'actived_date'     => ['type'=> 'datetime'],
            'referal_by'     => ['type'=> 'text'],
            'approved_date'   => ['type'=> 'datetime'],
            'status_document' => ['type'=> 'dropdown'],
            'created_at' => ['type'=> 'datetime'],
            'created_by' => ['type'=> 'select2'],
            'updated_at' => ['type'=> 'datetime'],
            'updated_by' => ['type'=> 'select2']
    ];
    
    public $listShow = [
        //'id'=>[] ,
        'name'=>['type'=>'custom','call_m'=> 'name_callback' ,'callback_execute'=>'name_callback($item)','callback_function'=>'function name_callback($item)
        {
            return $item["first_name"].\' \'.$item["last_name"];
        }'], 
        
        //'first_name'=>[], 
        //'last_name'=>[], 
        'phone_no'=>[], 
        'birthday'=>[], 
        'join_date'=>[],
        'actived_date'=>[],
        //'status_document'=>['enum'=>['draft','lock'],'enum_default'=>'draft'],
        'updated_at'=>[],
        //'updated_by'=>['related_table'=>'user','related_value'=>'name']
    ];

    public $createShow=[
        'id'=>[] ,
        'first_name'=>[], 
        'last_name'=>[] , 
        'phone_no'=>[], 
        'birthday'=>[],
        'pin'=>[], 
        'join_date'=>[],
        'actived_date'=>[],
        'status_document'=>['enum'=>['draft','lock'],'enum_default'=>'draft'],
    ];

    public $detailShow=[
        'id' ,
        'first_name', 
        'last_name' , 
        'phone_no', 
        'birthday', 
        'join_date',
        'actived_date',
        'status_document',
        'updated_at',
        'updated_by'=>['related_table'=>'user','related_value'=>'name']
    ];

    public function index()
    {
        $members = Member::all(); // Get all members
        return MemberResource::collection($members); // Return resource collection
    }
    
    public function create(request $request,response $response,$id=''){
        //$MemberResourse = MemberResource::collection(Member::find($id)->get())->toArray($request);
        //$data = $MemberResourse;
        $data = [];
        $config = [
                    'page'   => [
                        'title' => 'Member Create',
                        'description' => 'Member Create - Description',
                        'name' => 'Create Member',
                        'parent' => 'Members',
                        'author' => 'Telcomixo',
                    ],
                    'module' => 'member',
                    'obj'=> new Member,
                    'route'  => 'members',
                    'meta'=> $this->meta,
                    'data' => $data,

                ];
        return view('PanelAdmin.Member.create',compact('config'));
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
                    'module' => 'member',
                    'route'  => 'member',
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
        return view('PanelAdmin.Member.detail',compact('config'));
    }

    public function list(request $request,response $response){

       
        $MemberResourse = MemberResource::collection(Member::All())->toArray($request);
        $data = $MemberResourse;
        $config = [
                    'page'   => [
                        'title' => 'Member List',
                        'description' => 'Member Listing - Description',
                        'name' => 'Listing Members',
                        'parent' => 'Members',
                        'author' => 'Telcomixo',
                    ],
                    'module' => 'member',
                    'route'  => 'member',
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
                        'Total Member'   => [
                            'name'=> 'Total Member',
                            'icon'=> 'ri-user-3-line font-size-24',
                            'module'=> 'member',
                            'count-value'=> '100',
                            'percentage-value'=> '20%',                            
                            'render'=> '',
                            'onClick'=> ''
                        ],
                       
                        'Today Session' => [
                            'name'=> 'Today Session',
                            'icon'=> 'ri-user-3-line font-size-24',
                            'module'=> 'member',
                            'count-value'=> '30',
                            'percentage-value'=> '15%',
                            'render'=> '',
                            'onClick'=> ''
                        ],
                        'Active Member'   => [
                            'name'=> 'Total Member',
                            'icon'=> 'ri-user-3-line font-size-24',
                            'module'=> 'member',
                            'count-value'=> '100',
                            'percentage-value'=> '20%',                            
                            'render'=> '',
                            'onClick'=> ''
                        ],
                        'Not Active Member'   => [
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
      
        return view('PanelAdmin.Member.list',compact('config'));
    }
}

 // $user = User::find(1)->toArray($request);
       // $userResource = UserResource::collection(collect([$user]))->toArray($request);
        //print_r('<pre>');
        
       // print_r(($MemberResourse));
        //exit();
       // print_r(((array)$data[0])['resource']->getAttributes());
       
       //$keyNames = array_keys(((array)$data[0])['resource']->getAttributes());
       // print_r($keyNames);
      // exit();