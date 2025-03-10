<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;         
use Illuminate\Http\Response; 
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Helpers\H1BHelper;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; 
class UserController extends Controller
{
    public $columns = [
        ['data' => 'action', 'width' => '5%'],
        ['data' => 'role_id', 'width' => '35%'],
        ['data' => 'name', 'width' => '35%'],
        ['data' => 'phoneno', 'width' => '10%'],
        ['data' => 'email', 'width' => '25%'],
        ['data' => 'updated_at', 'width' => '10%']
    ];

    public  $meta = [ 
        'id'              => ['type'=> 'text' ,'label' => 'ID'],
        'role_id'            => ['type'=> 'select2' ,'label' => 'RoleName'],
        'name'            => ['type'=> 'text' ,'label' => 'Name'],
        'phoneno'        => ['type'=> 'text' ,'label' => 'PhoneNo'],
        'email'          => ['type'=> 'text','label' => 'Email'],
        'email_verified_at' => ['type'=>'datetime','label' => 'EmailVerifiedAt'],
        'password'        => ['type'=>'text','label' => 'Password'],
        'created_at' => ['type'=> 'datetime','label' => 'CreateBy'],
        'created_by' => ['type'=> 'select2','label' => 'CreatedBy'],
        'updated_at' => ['type'=> 'datetime','label' => 'UpdateAt'],
        'updated_by' => ['type'=> 'select2','label' => 'UpdateBy']
    ];

    public $listShow = [
        //'id'=>[] ,
        'role_id'=>[],
        'name'=>[], 
        'phoneno'=>[],
        'email'=>[],
        'updated_at'=>[],

    ];

    public $createShow=[
        //'id' =>['width'=> 'col-md-0'],
        'role_id'=>['width'=> 'col-md-12','related_table'=>'App\Models\Role\Role','related_value'=>'role_name'],
        'name'=>['width'=>'col-md-8'] , 
        'phoneno'=>['width'=>'col-md-4'],
        'password'=>['width'=>'col-md-6'],
        'email'=>['width'=>'col-md-6']
    ];

    public $detailShow=[
        //'id'=>['width'=>'col-md-0']  ,
        'role_id'=>['width'=> 'col-md-12','related_table'=>'App\Models\Role\Role','related_value'=>'role_name'],
        'name'=>['width'=>'col-md-4'] , 
        'phoneno'=>['width'=>'col-md-4'],
        //'password'=>['width'=>'col-md-6'],
        'email'=>['width'=>'col-md-4'],
        'created_at'=>['width'=> 'col-md-3'],
        'created_by'=>['width'=> 'col-md-3','related_table'=>'App\Models\User','related_value'=>'name'],
        'updated_at'=>['width'=> 'col-md-3'],
        'updated_by'=>['width'=> 'col-md-3','related_table'=>'App\Models\User','related_value'=>'name']
    ];

    public function index()
    {
        $users = User::all(); // Get all users
        return UserResource::collection($users); // Return resource collection
    }

    public function getData(Request $request)
    {
        // Fetch the data from the model
        // $members = Member::all(); // Adjust according to your needs
        $Users = User::select([
            'id',
            'role_id',
            'name', // Combine first and last name
            'phoneno',
            'email',
            'password',
            'created_at',
            'updated_at',
            'updated_by',
            'created_by'
        ])
        ->get();

        $s = datatables()->of($Users)
            ->editColumn('role_id', function ($user) {
                //$valueCol = $user->role_id;
                $id =  $user->role_id;
                $field = 'role_name';
                $MetaValue['related_table'] = 'App\Models\Role\Role';
                return view('PanelAdmin.component.select2.view',compact('id','field','MetaValue'));
            })
            ->editColumn('updated_at', function ($user) {
                $valueCol = $user->updated_at;
            
                return view('PanelAdmin.component.datetime.view',compact('valueCol'));
            })
            ->addColumn('action', function ($user) {
                $module_data = $user;
                $route = 'User';
                return view('PanelAdmin.component.action_grid.view', compact('module_data','route')); // Create a Blade view for action buttons
            })
            ->make(true);
        
        return $s;
    
    }
    public function delete(request $request,response $response){
        $id = $request->id;
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully!',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not found!',
            ], 404);
        }
    }
    public function edit(request $request,response $response,$id){
        $param = $request->input();
        unset($param['_token']);
        $param['id'] = $id;
        $param['updated_by']=Auth::User()->id;
        $user = User::find($id);
        
        if ($user) {
            // Update the instructor's attributes
            $user->update($param);
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
        try{
            $validatedData = $request->validate([
                'role_id' => 'required',
                'name' => 'required|string|max:255',
                'phoneno' => 'required|string|max:255',
                'password' => 'required|integer|min:4', // Adjust max length as needed
                'email' => 'required|email',
            ]);
            
            $User = User::create([
                'role_id' => $validatedData['role_id'],
                'name' => $validatedData['name'],
                'phoneno' => $validatedData['phoneno'],
                'password' => $validatedData['password'],
                'email' => $validatedData['email'],
                'updated_by'=> Auth::user()->id,
                'created_by'=> Auth::user()->id
            ]);
            //dd($User);
            return response()->json([
                'success' => true,
                'message' => 'User created successfully!',
                'user' => $User,
            ]);
        } catch(Exception $e){
            
            return response()->json([
                'success' => false,
                'message' => 'Please Check Again Due error or data duplicate',
                'user' => $User,
            ]);
        }
        
    }

    public function create(request $request,response $response,$id=''){
        
        $data = [];
        $config = [
                    'page'   => [
                        'title' => 'User Create',
                        'description' => 'User Create - Description',
                        'name' => 'Create User',
                        'parent' => 'users',
                        'author' => 'Telcomixo',
                    ],
                    'module' => 'user',
                        'route'  => 'user',
                        'meta'=> H1BHelper::combine_based_on_second($this->meta,$this->createShow),
                        'data' => $data,
                        'relation'=>[
                            '0'   => [
                                'id'=> 'my-package-variant',
                                'icon'=> '<i class="far fa-envelope"></i>',
                                'name'=> 'Package Variant',
                                
                                'type'=> 'crud',
                                'module'=> 'package_variant',
                                'render'=> 'PanelAdmin.Package.component.Tab.packageVariant',
                                
                            ],
                        
                            
                            
                        ]
                        
                    
                ];
        return view('PanelAdmin.User.create',compact('config'));
    }

    public function detail(request $request,response $response,$id){
        
        $UserResourse = UserResource::collection(User::where('id',$id)->get())->toArray($request);
        $data = $UserResourse;
        $config = [
            'page'   => [
                'title' => 'User Detail - ID:'.$id ,
                'description' => 'User Detail - Description',
                'name' => 'User Detail - [ '.$data[0]['name'].'/'.$id.' ]',
                'parent' => 'User',
                'author' => 'Telcomixo',
            ],
            'id'=>$id,
            'module' => 'user',
            'route'  => 'user',
            'meta'=> H1BHelper::combine_based_on_second($this->meta,$this->detailShow),
            'data' => $data,
            

        ];
        return view('PanelAdmin.User.detail',compact('config'));
    }

    public function list(request $request,response $response){

        $UserResourse = UserResource::collection(User::All())->toArray($request);
        $prevMonthCount = User::where('created_at','<', Carbon::now()->subMonthsNoOverflow()->endOfMonth()->toDateString())->count();
        $totalCount = User::All()->count();
        if($totalCount == 0){
            $percentageUser = 0;
        }
        else
        {
            $percentageUser = (($totalCount-$prevMonthCount)/$totalCount)*100;
        }
      
        $data = $UserResourse;
        $config = [
                    'page'   => [
                        'title' => 'User List',
                        'description' => 'User Listing - Description',
                        'name' => 'Listing users',
                        'parent' => 'users',
                        'author' => 'Telcomixo',
                    ],
                    'module' => 'user',
                    'columns' => json_encode($this->columns,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                    'objModule'=> User::All(),
                    'route'  => 'user',
                    'sort' =>"[[1, 'desc']]",
                    'meta'=> H1BHelper::combine_based_on_second($this->meta,$this->listShow),
                    'metaCreate'=> H1BHelper::combine_based_on_second($this->meta,$this->createShow),
                    'data' => $data,
                    'register_callback',
                    'button'=>[
                        'Export Excel'=>[
                            'name'=>'Export Excel',
                            'route'=>'users/create',
                            'icon'=>'ri-add-line',
                            'onClick'=>''
                        ],
                        'Export PDF'=>[
                            'name'=>'Export Excel',
                            'route'=>'users/create',
                            'icon'=>'ri-add-line',
                            'onClick'=>''
                        ],
                    ],
                    
                    'stat'=>[
                        'Total User'   => [
                            'name'=> 'Total User',
                            'width'=> 'col-md-12',
                            'icon'=> 'ri-user-3-line font-size-24',
                            'module'=> 'User',
                            'count-value'=> $totalCount,
                            'percentage-value'=>  H1BHelper::isHasDecimal($percentageUser).'%',                            
                                                    
                            'render'=> '',
                            'onClick'=> ''
                        ],
                        
                    ]
                ];
  
         return view('PanelAdmin.User.list',compact('config'));
    }

    public function profile(request $request,response $response){

        $id = Auth::User()->id;
        $UserResourse = UserResource::collection(User::find($id)->get())->toArray($request);
        $data = $UserResourse;
        $config = [
                    'page'   => [
                        'title' => 'User Profile',
                        'description' => 'Profile - Description',
                        'name' => 'User Profile',
                        'parent' => 'users',
                        'author' => 'Telcomixo',
                    ],
                    'id'=>$id,
                    'module' => 'user',
                    'columns' => json_encode($this->columns,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                    'objModule'=> User::find($id),
                    'route'  => 'user',
                    'meta'=> H1BHelper::combine_based_on_second($this->meta,$this->detailShow),
                    'data' => $data,
        ];
      
     
        return view('PanelAdmin.User.profile',compact('config'));
    }
}