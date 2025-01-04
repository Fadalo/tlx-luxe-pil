<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;
use Illuminate\Http\Response; 
use App\Http\Controllers\Controller; 
       

use App\Http\Resources\Instructor\InstructorResource;
use App\Http\Resources\UserResource;
use App\Models\Instructor\Instructor;
use App\Models\User;
use App\Helpers\H1BHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class InstructorController extends Controller
{
    public $columns = [
        ['data' => 'action', 'width' => '5%'],
        ['data' => 'id2', 'width' => '5%'],
        
        ['data' => 'type', 'width' => '15%'],
        
        ['data' => 'name', 'width' => '45%'],
        ['data' => 'phone_no', 'width' => '10%'],
        ['data' => 'birthday', 'width' => '10%'],
        ['data' => 'updated_at', 'width' => '10%']
    ];
    public  $meta = [ 
            'id'              => ['type'=> 'hidden','label'=>'ID'],
            'id2'             => ['type'=> 'text','label'=>'ID'],
            
            'type'      => ['type'=> 'dropdown','label'=>'Type'],
            
            'first_name'      => ['type'=> 'text','label'=>'First Name'],
            'last_name'       => ['type'=> 'text','label'=>'Last Name'],
            'phone_no'        => ['type'=> 'phone','label'=>'Phone No'],
            'birthday'        => ['type'=> 'date','label'=>'Birthday'],
            'pin'             => ['type'=> 'password','label'=>'PIN'],
            'join_date'       => ['type'=> 'datetime','label'=>'Join Date'],
            'actived_date'     => ['type'=> 'datetime','label'=>'Activated Date'],
            'status'         => ['type'=> 'dropdown','label'=>'Status'],
            'approved_date'   => ['type'=> 'datetime','label'=>'Approved Date'],
            'status_document' => ['type'=> 'dropdown','label'=>'Status Document'],
            'created_at' => ['type'=> 'datetime','label'=>'Created At'],
            'created_by' => ['type'=> 'select2','label'=>'Created By'],
            'updated_at' => ['type'=> 'datetime','label'=>'Updated At'],
            'updated_by' => ['type'=> 'select2','label'=>'Updated By']
    ];

    public $listShow = [
        'id2'=>[] ,
        'type'=>[],
        'name'=>['label'=>'Name','type'=>'custom','call_m'=> 'name_callback' ,'callback_execute'=>'name_callback($item)','callback_function'=>'function name_callback($item)
        {
            return $item["first_name"].\' \'.$item["last_name"];
        }'], 
        
        //'first_name'=>[], 
        //'last_name'=>[], 
        'phone_no'=>[], 
        'birthday'=>[], 
       // 'join_date'=>[],
    //    'actived_date'=>[],
        //'status_document'=>['enum'=>['draft','lock'],'enum_default'=>'draft'],
        'updated_at'=>[],
        //'updated_by'=>['related_table'=>'user','related_value'=>'name']
    ] ;

    public $createShow=[
       // 'id'=>['width'=>'col-md-0'] ,
        'type'=>['width'=>'col-md-12','enum'=>['permanent','temporary'],'enum_default'=>'permanent'], 
        'first_name'=>['width'=>'col-md-6'], 
        'last_name'=>['width'=>'col-md-6'] , 
        'phone_no'=>['width'=>'col-md-8'],  
        'pin'=>['width'=>'col-md-4'], 
        'birthday'=>['width'=>'col-md-12'],
       // 'join_date'=>['width'=>'col-md-4'],
       // 'actived_date'=>['width'=>'col-md-4'],
       // 'status_document'=>['width'=>'col-smd-4','enum'=>['draft','locked'],'enum_default'=>'draft'],
    ];

    public $detailShow=[
        'id'=>['width'=>'col-md-0'] ,
        'type'=>['width'=>'col-md-12','enum'=>['permanent','temporary'],'enum_default'=>'permanent'], 
        'first_name'=>['width'=>'col-md-6'], 
        'last_name'=>['width'=>'col-md-6'] , 
        
        'phone_no'=>['width'=>'col-md-8'], 
        'pin'=>['width'=>'col-md-4'], 
        'birthday'=>['width'=>'col-md-12'],
        
        'join_date'=>['width'=>'col-md-4'],
        'actived_date'=>['width'=>'col-md-4'],
        'status_document'=>['width'=>'col-md-4','enum'=>['draft','locked'],'enum_default'=>'draft'],
        'created_at'=>['width'=>'col-md-3',],
        'created_by'=>['width'=>'col-md-3','related_table'=>'App\Models\User','related_value'=>'name'],
        'updated_at'=>['width'=>'col-md-3',],
        'updated_by'=>['width'=>'col-md-3','related_table'=>'App\Models\User','related_value'=>'name']
    ];
   
    public function index()
    {
        $instructors = Instructor::all(); // Get all members
        return InstuctorResource::collection($instructors); // Return resource collection
    }
    public function getData(Request $request)
    {
        // Fetch the data from the model
       // $members = Member::all(); // Adjust according to your needs
        $Instructors = Instructor::select([
            'id',
            'id as id2',
            'type',
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
            //print_r($Instructors);
            //exit();
        

        $s = datatables()->of($Instructors)
            ->editColumn('updated_at', function ($instructor) {
                $valueCol = $instructor->updated_at;
                //return $member->join_date;
                return view('PanelAdmin.component.datetime.view',compact('valueCol'));
            })
            ->editColumn('actived_date', function ($instructor) {
                $valueCol = $instructor->actived_date;
                //return $member->join_date;
                return view('PanelAdmin.component.datetime.view',compact('valueCol'));
            })
            ->editColumn('birthday', function ($instructor) {
                $valueCol = $instructor->birthday;
                //return $member->join_date;
                return view('PanelAdmin.component.date.view',compact('valueCol'));
            })
            ->editColumn('join_date', function ($instructor) {
                $valueCol = $instructor->join_date;
                 //return $member->join_date;
                 return view('PanelAdmin.component.date.view',compact('valueCol'));
            })
            ->addColumn('action', function ($instructor) {
                $module_data = $instructor;
                //print_r($instructor);
                //exit();
                $route = 'instructor';
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
        $instructor = Instructor::find($id);
        if ($instructor) {
            $instructor->delete();
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
    public function edit_pin(request $request,response $response,$id){
        $param = $request->input();
        unset($param['_token']);
        $param['id'] = $id;
        $param['updated_by']=Auth::User()->id;
        $instructor = Instructor::find($id);
        
        if ($instructor) {
            // Update the instructor's attributes
            $instructor->update($param);
            return response()->json([
                'success' => true,
                'message' => 'field update successfully!'
               
            ]);
        } else {
            return response()->json(['success'=>false,'message' => 'field failed']);
        }
        
    }
    public function edit(request $request,response $response,$id){
        $param = $request->input();
        unset($param['_token']);
        $param['id'] = $id;
        $param['updated_by']=Auth::User()->id;
        $instructor = Instructor::find($id);
        
        if ($instructor) {
            // Update the instructor's attributes
            $instructor->update($param);
            return response()->json([
                'success' => true,
                'message' => 'field update successfully!'
               
            ]);
        } else {
            return response()->json(['success'=>false,'message' => 'field failed']);
        }
        
    }
    
    public function store(request $request,response $response)
    {
        //print_r(Auth::user()->id);
        //exit();
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_no' => 'required|string|max:255',
            'pin' => 'required|integer|min:4', // Adjust max length as needed
            'birthday' => 'required|date',
        ]);
        
        $instructor = Instructor::create([
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
            'message' => 'Instructor created successfully!',
            'member' => $instructor,
        ]);
    }
    
    public function create(request $request,response $response){
        $data = [];
        $config = [
                    'page'   => [
                        'title' => 'Instructor Create',
                        'description' => 'Instructor Create - Description',
                        'name' => 'Create Instructors ',
                        'parent' => 'Instructor',
                        'author' => 'Telcomixo',
                    ],
                    'module' => 'instructor',
                    'route'  => 'instructor',
                    'meta'=> H1BHelper::combine_based_on_second($this->meta,$this->createShow),
                    'data' => $data,
                    'relation'=>[]
                ];
        return view('PanelAdmin.Instructor.create',compact('config'));
    }

    public function detail(request $request,response $response,$id){
        
        $InstructorResource = InstructorResource::collection(Instructor::where('id',$id)->get())->toArray($request);
        $data = $InstructorResource;
        $config = [
                    'page'   => [
                        'title' => 'Intructor Detail - ID:'.$id ,
                        'description' => 'Intructor Detail - Description',
                        'name' => 'Detail Intructor - [ '.$data[0]['first_name'].'/'.$id.' ]',
                        'parent' => 'Intructors',
                        'author' => 'Telcomixo',
                    ],
                    'id'=>$id,
                    'module' => 'instructor',
                    'route'  => 'instructor',
                    'meta'=> H1BHelper::combine_based_on_second($this->meta,$this->detailShow),
                    'data' => $data,
                    'relation'=>[
                        '0'   => [
                            'id'=> 'my-contract',
                            'icon'=> '<i class="ri-file-paper-2-line"></i>',
                            'name'=> 'My Contract',
                            'type'=> 'crud',
                            'module'=> 'member_order',
                            'render'=> 'PanelAdmin.Instructor.Component.Tab.my-contract',
                        ],
                        '2' => [
                            'id'=> 'my-schedule',
                            'icon'=> '<i class="ri-calendar-event-line"></i>',
                            'name'=> 'My Schedule',
                            'module'=> 'batch',
                            'render'=> 'PanelAdmin.Instructor.Component.Tab.my-scheadule',
                        ],
                       '3' => [
                            'id'=> 'my-chat',
                            'icon'=> '<i class="ri-whatsapp-fill"></i>',
                            'name'=> 'My Chat',
                            'module'=> 'member',
                            'render'=> 'PanelAdmin.Instructor.Component.Tab.my-chat',
                        ],
                        '4' => [
                            'id'=> 'my-settings',
                            'icon'=> '<i class="ri-settings-2-line"></i>',
                            'name'=> 'My Settings',
                            'module'=> 'member',
                            'render'=> 'PanelAdmin.Instructor.Component.Tab.my-settings',
                        ],
                        
                        
                    ]

                ];
        return view('PanelAdmin.Instructor.detail',compact('config'));
    }
    
    public function list(request $request,response $response){

        $InstructorResourse = InstructorResource::collection(Instructor::All())->toArray($request);
        $prevMonthCount = Instructor::where('created_at','<',Carbon::now()->subMonthsNoOverflow()->endOfMonth()->toDateString())->count();
        $totalCount = Instructor::All()->count();
        $percentageInstructor = (($totalCount-$prevMonthCount)/$totalCount)*100;
        $data = $InstructorResourse;
        $config = [
                    'page'   => [
                        'title' => 'Instructor List',
                        'description' => 'Instructor Listing - Description',
                        'name' => 'Listing Instructor',
                        'parent' => 'Instructor',
                        'author' => 'Telcomixo',
                    ],
                    'module' => 'instructor',
                    'columns' => json_encode($this->columns,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                    'objModule'=> Instructor::All(),
                    'route'  => 'instructor',
                    'sort' =>"[[4, 'desc']]",
                    'meta'=> H1BHelper::combine_based_on_second($this->meta,$this->listShow),
                    'metaCreate'=> H1BHelper::combine_based_on_second($this->meta,$this->createShow),
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
                            'name'=> 'Total Instructor',
                            'width'=> 'col-md-12',
                            'icon'=> 'ri-user-3-line font-size-24',
                            'module'=> 'instructor',
                            'count-value'=> $totalCount,
                            'percentage-value'=> H1BHelper::isHasDecimal($percentageInstructor).' %',                            
                            'render'=> '',
                            'onClick'=> ''
                        ],
                       
                       
                       
                        
                    ]
                ];
      
        return view('PanelAdmin.Instructor.list',compact('config'));
    }
}