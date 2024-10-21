<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;         
use Illuminate\Http\Response; 
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Helpers\H1BHelper;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public $columns = [
        ['data' => 'action', 'width' => '5%'],
        ['data' => 'name', 'width' => '35%'],
        ['data' => 'phoneno', 'width' => '10%'],
        ['data' => 'email', 'width' => '25%'],
        ['data' => 'updated_at', 'width' => '10%']
    ];

    public  $meta = [ 
        'id'              => ['type'=> 'text' ,'label' => 'ID'],
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
        'name'=>[], 
        'phoneno'=>[],
        'email'=>[],
        'updated_at'=>[],

    ];

    public $createShow=[
        //'id' =>['width'=> 'col-md-0'],
        'name'=>['width'=>'col-md-8'] , 
        'phoneno'=>['width'=>'col-md-4'],
        'password'=>['width'=>'col-md-6'],
        'email'=>['width'=>'col-md-6']
    ];

    public $detailShow=[
        //'id'=>['width'=>'col-md-0']  ,
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

    public function store(request $request,response $response)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phoneno' => 'required|string|max:255',
            'password' => 'required|integer|min:4', // Adjust max length as needed
            'email' => 'required|email',
        ]);
        
        $instructor = Instructor::create([
            'name' => $validatedData['name'],
            'phoneno' => $validatedData['phoneno'],
            'password' => $validatedData['password'],
            'email' => $validatedData['email'],
            'updated_by'=> Auth::user()->id,
            'created_by'=> Auth::user()->id
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'User created successfully!',
            'member' => $member,
        ]);
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
        
        $UserResourse = UserResource::collection(User::find($id)->get())->toArray($request);
        $data = $UserResourse;
        $config = [
            'page'   => [
                'title' => 'User Detail - ID:'.$id ,
                'description' => 'User Detail - Description',
                'name' => 'User Detail - [ '.$data[0]['name'].'/'.$id.' ]',
                'parent' => 'User',
                'author' => 'Telcomixo',
            ],
            'module' => 'user',
            'route'  => 'user',
            'meta'=> H1BHelper::combine_based_on_second($this->meta,$this->detailShow),
            'data' => $data,
            

        ];
        return view('PanelAdmin.User.detail',compact('config'));
    }

    public function list(request $request,response $response){

        $UserResourse = UserResource::collection(User::All())->toArray($request);
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
                            'icon'=> 'ri-user-3-line font-size-24',
                            'module'=> 'User',
                            'count-value'=> '100',
                            'percentage-value'=> '20%',                            
                            'render'=> '',
                            'onClick'=> ''
                        ],
                        
                    ]
                ];
  
         return view('PanelAdmin.User.list',compact('config'));
    }

    public function profile(request $request,response $response){

        $id = Auth::User()->id;
        $config = [
                    'page'   => [
                        'title' => 'User Profile',
                        'description' => 'Profile - Description',
                        'name' => 'User Profile',
                        'parent' => 'users',
                        'author' => 'Telcomixo',
                    ],
                    'module' => 'user',
                    'columns' => json_encode($this->columns,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                    'objModule'=> User::find($id),
                    'route'  => 'user'
        ];

        return view('PanelAdmin.User.profile',compact('config'));
    }
}