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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class MemberController extends Controller
{
    public $columns = [
        ['data' => 'action', 'width' => '5%'],
        ['data' => 'name', 'width' => '25%'],
        ['data' => 'phone_no', 'width' => '10%'],
        ['data' => 'birthday', 'width' => '10%'],
        ['data' => 'join_date', 'width' => '10%'],
        ['data' => 'actived_date', 'width' => '10%'],
        ['data' => 'updated_at', 'width' => '10%']
    ];
    public  $meta = [ 
            'id'              => ['type'=> 'hidden','label'=>'ID'],
            'first_name'      => ['type'=> 'text','label'=>'First Name'],
            'last_name'       => ['type'=> 'text','label'=>'Last Name'],
            'phone_no'        => ['type'=> 'phone','label'=>'Phone No'],
            'birthday'        => ['type'=> 'date','label'=>'Birthday'],
            'pin'             => ['type'=> 'password','label'=>'PIN'],
            'join_date'       => ['type'=> 'datetime','label'=>'Join Date'],
            'actived_date'     => ['type'=> 'datetime','label'=>'Activated Date'],
            'referal_by'     => ['type'=> 'text','label'=>'Referal By'],
            'approved_date'   => ['type'=> 'datetime','label'=>'Approved Date'],
            'status_document' => ['type'=> 'dropdown','label'=>'Status Document'],
            'created_at' => ['type'=> 'datetime','label'=>'Created At'],
            'created_by' => ['type'=> 'select2','label'=>'Created By'],
            'updated_at' => ['type'=> 'datetime','label'=>'Updated At'],
            'updated_by' => ['type'=> 'select2','label'=>'Updated By']
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
        'id'=>['width'=>'col-md-0'] ,
        'first_name'=>['width'=>'col-md-6'], 
        
        'last_name'=>['width'=>'col-md-6'] , 
        //'status_document'=>['width'=>'col-md-4','enum'=>['draft','locked'],'enum_default'=>'draft'],
        'phone_no'=>['width'=>'col-md-8'], 
        'pin'=>['width'=>'col-md-4'], 
        'birthday'=>['width'=>'col-md-12'],
        
        //'join_date'=>['width'=>'col-md-4'],
        //'actived_date'=>['width'=>'col-md-4'],
        
        //'updated_by'=>['width'=>'col-md-3']

    ];

    public $detailShow=[
        'id'=>['width'=>'col-md-0'] ,
        'first_name'=>['width'=>'col-md-6'], 
        'last_name'=>['width'=>'col-md-6'] , 
        'phone_no'=>['width'=>'col-md-8'],       
        'pin'=>['width'=>'col-md-4'], 
        'birthday'=>['width'=>'col-md-12'],
        'join_date'=>['width'=>'col-md-4'],
        'actived_date'=>['width'=>'col-md-4'],
        'status_document'=>['width'=>'col-md-4','enum'=>['draft','locked'],'enum_default'=>'draft'],
        'created_at'=>['width'=>'col-md-3'],
        'created_by'=>['width'=>'col-md-3','related_table'=>'App\Models\User','related_value'=>'name'],
        'updated_at'=>['width'=>'col-md-3'],
        'updated_by'=>['width'=>'col-md-3','related_table'=>'App\Models\User','related_value'=>'name']
    ];

    public function index()
    {
        $members = Member::all(); // Get all members
        return MemberResource::collection($members); // Return resource collection
    }
    public function getData(Request $request)
    {
        // Fetch the data from the model
       // $members = Member::all(); // Adjust according to your needs
        $members = Member::select([
            'id',
            DB::raw("CONCAT(first_name, ' ', last_name) AS name"), // Combine first and last name
            'phone_no',
            'join_date',
            'birthday',
            'actived_date', // Ensure the column names match your database
            'created_at',
            'updated_at',
            'updated_by',
            'created_by'
            
            
        ])
        ->get();

        

        $s = datatables()->of($members)
            ->editColumn('updated_at', function ($member) {
                $valueCol = $member->updated_at;
                //return $member->join_date;
                return view('PanelAdmin.component.datetime.view',compact('valueCol'));
            })
            ->editColumn('actived_date', function ($member) {
                $valueCol = $member->actived_date;
                //return $member->join_date;
                return view('PanelAdmin.component.datetime.view',compact('valueCol'));
            })
            ->editColumn('birthday', function ($member) {
                $valueCol = $member->birthday;
                //return $member->join_date;
                return view('PanelAdmin.component.date.view',compact('valueCol'));
            })
            ->editColumn('join_date', function ($member) {
                $valueCol = $member->join_date;
                 //return $member->join_date;
                 return view('PanelAdmin.component.date.view',compact('valueCol'));
            })
            ->addColumn('action', function ($member) {
                $route = 'member';
                $module_data = $member;
                return view('PanelAdmin.component.action_grid.view', compact('module_data','route')); // Create a Blade view for action buttons
               // return '';
            })
            ->make(true);
            //exit();
       // return json_encode($s->getData()->data);
       return $s;
       // exit();
    }
    public function delete(request $request,response $response){
        $id = $request->id;
        $member = Member::find($id);
        if ($member) {
            $member->delete();
            return response()->json([
                'success' => true,
                'message' => 'Member deleted successfully!',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Member not found!',
            ], 404);
        }
    }
    public function store(request $request,response $response)
    {
        //print_r(Auth::user()->id);
        //exit();
        
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_no'   => 'required|string|max:15', // Phone numbers usually have a max length limit
            'pin'        => 'required|digits:4', // Ensures exactly 4 digits are allowed
            'birthday'   => 'required|date|before:today',
        ]);
        
        $m = Member::where('phone_no',$validatedData['phone_no'])->first();
        //print_r(isset($m->id));
        //exit();
        if(!isset($m->id)){
            $member = Member::create([
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'phone_no' => $validatedData['phone_no'],
                'pin' => $validatedData['pin'],
                'birthday' => $validatedData['birthday'],
                'updated_by'=> Auth::user()->id,
                'created_by'=> Auth::user()->id
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Member created successfully!',
                //'member' => $member,
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Member Already Exits',
                //'member' => $member,
            ]);
        }
    }
    public function create(request $request,response $response,$id=''){
        //$MemberResourse = MemberResource::collection(Member::find($id)->get())->toArray($request);
        //$data = $MemberResourse;
        $data = [];
        $config = [
                    'page'   => [
                        'title' => 'Member Create',
                        'description' => 'Member Create - Description',
                        'name' => 'Create Members ',
                        'parent' => 'Members',
                        'author' => 'Telcomixo',
                    ],
                    'module' => 'member',
                    'route'  => 'member',
                    'meta'=> H1BHelper::combine_based_on_second($this->meta,$this->createShow),
                    'data' => $data,
                    'relation'=>[]
                ];
        return view('PanelAdmin.Member.create',compact('config'));
    }

    public function detail(request $request,response $response,$id){
        
        
        $MemberResourse = MemberResource::collection(Member::where('id',$id)->get())->toArray($request);
        $data = $MemberResourse;
        //print_r('<pre>');
       // print_r($data);
       // exit();
        $config = [
                    'page'   => [
                        'title' => 'Member Detail - ID:'.$id ,
                        'description' => 'Member Detail - Description',
                        'name' => 'Detail Members - [ '.$data[0]['first_name'].'/'.$id.' ]',
                        'parent' => 'Members',
                        'author' => 'Telcomixo',
                    ],
                    'module'  => 'member',
                    'route'   => 'member',
                    
                    'meta'=> H1BHelper::combine_based_on_second($this->meta,$this->detailShow),
                    'data' => $data,
                    'relation'=>[
                        '0'   => [
                            'id'=> 'my-package',
                            'name'=> 'My Package',
                            'icon'=> '<i class="ri-archive-line"></i>',
                            'type'=> 'crud',
                            'module'=> 'member',
                            'moduleClass'=>'App\Models\Member\Member',
                            'render'=> 'PanelAdmin.Member.component.Tab.my-package',
                            'submodule' =>[
                                'tabs'=> [
                                    'title'=> 'sb1',
                                    'desc' => 'sb1',
                                    'render' => 'PanelAdmin.component.tab-vertical.view',
                                    'data'=>[
                                        '0' => [
                                            'id'=> 'create_package',
                                            'title' => 'Create Package',
                                            'is_actived'=> 'false',
                                            'desc' => '',
                                            'render'=> 'PanelAdmin.PackageOrder.create',
                                            
                                        ],
                                        '1' => [
                                            'id'=> 'list_package_by_status',
                                            'title' => 'List Package',
                                            'is_actived'=> 'true',
                                            'desc' => '',
                                            'render' => 'PanelAdmin.PackageOrder.listByStatus',
                                            'submodule_data'=>[
                                                'tabs'=> [
                                                    'title'=> 'MY PACKAGE',
                                                    'desc'=> 'PACKAGE ORDER',
                                                    'data'=> [
                                                        '0' => [
                                                            'id' => 'list_by_status_book',
                                                            'name'=>'Book',
                                                            'is_actived'=> 'false',
                                                            'render'=> 'PanelAdmin.Member.component.Tab.my-card-book',
                                                         ],
                                                        '1' => [
                                                                'id' => 'list_by_status_available',
                                                                'name'=>'Available',
                                                                'is_actived'=> 'false',
                                                                'render'=> 'PanelAdmin.Member.component.Tab.my-card-available',
                                                        ],
                                                        '2' => [
                                                                'id' => 'list_by_status_activated',
                                                                'name'=>'Actived',
                                                                'is_actived'=> 'true',
                                                                'render'=> 'PanelAdmin.Member.component.Tab.my-card-activated',
                                                        ],
                                                        '3' => [
                                                                'id' => 'list_by_status_expired',
                                                                'name'=>'Expired',
                                                                'is_actived'=> 'false',
                                                                'render'=> 'PanelAdmin.Member.component.Tab.my-card-expired',
                                                        ]
                                                    ]
                                                ],
                                            ],
                                        ]
                                    ]
                                   
                                ]
                            ],
                            
                            
                        ],
                        '2' => [
                            'id'=> 'my-scheadule',
                            'icon'=> '<i class="ri-calendar-2-line"></i>',
                            'name'=> 'My Scheadule',
                            'module'=> 'member',
                            'moduleClass'=>'App\Models\Member\Member',
                            'render'=> 'PanelAdmin.Member.component.Tab.my-scheadule',
                            'submodule'=>[
                                'tabs'=> [
                                    'title'=> 'MY PACKAGE',
                                    'desc'=> 'PACKAGE ORDER',
                                    'data'=> [
                                        '0' => [
                                                'title'=>'Create Scheadule',
                                                'render'=> 'PanelAdmin.Member.component.Tab.my-card',
                                        ],
                                        '1' => [
                                                'title'=>'Scheadule',
                                                'render'=> 'PanelAdmin.Member.component.Tab.my-card',
                                        ]
                                    ]
                                ],
                            ],
                        ],
                        '3' => [
                            'id'=> 'my-invoice',
                            'icon'=> '<i class="ri-currency-fill"></i>',
                            'name'=> 'My History Payment',
                            'module'=> 'member_order_payment',
                            'render'=> 'PanelAdmin.Member.component.Tab.my-invoice',
                        ],
                        '4' => [
                            'id'=> 'my-settings',
                            'icon'=> '<i class="ri-settings-2-line"></i>',
                            'name'=> 'My Settings',
                            'module'=> 'member',
                            'render'=> 'PanelAdmin.Member.component.Tab.my-settings',
                        ]
                        
                        
                    ],

                ];
        return view('PanelAdmin.Member.detail',compact('config'));
    }

    public function list(request $request,response $response){

      /* $objMember = Member::find(1);
       print_r('<pre>');
      // print_r($objMember->PackageOrder);
       foreach($objMember->PackageOrder as $objMemberPackageOrder){
        //print_r($objMemberPackageOrder->id);
        //print_r($objMemberPackageOrder->PackageVariant);
        foreach($objMemberPackageOrder->PackageVariant as $objMemberPackageOrder_PackageVariant){
            print_r($objMemberPackageOrder_PackageVariant->PackageVariantRule);
    
        }
        print_r('<br>');
       }
       exit;*/
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
                    'columns' => json_encode($this->columns,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                    'objModule'=> Member::All(),
                    'route'  => 'member',
                    'sort' =>"[[4, 'desc']]",
                    'meta'=> H1BHelper::combine_based_on_second($this->meta,$this->listShow),
                    'metaCreate'=> H1BHelper::combine_based_on_second($this->meta,$this->createShow),
                    'data' => $data,
                    'register_callback',
                    'button'=>[
                        'Export Excel'=>[
                            'name'=>'Export Excel',
                            'route'=>'members/create',
                            'icon'=>'ri-add-line',
                            'onClick'=>''
                        ],
                        'Export PDF'=>[
                            'name'=>'Export Excel',
                            'route'=>'members/create',
                            'icon'=>'ri-add-line',
                            'onClick'=>''
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