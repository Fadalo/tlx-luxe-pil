<?php

namespace App\Http\Controllers\Role;

use Illuminate\Http\Request;
use Illuminate\Http\Response; 
use App\Http\Controllers\Controller; 
use App\Http\Resources\Role\RoleResource;
use App\Models\Role\Role;
use App\Models\User;
use App\Helpers\H1BHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class RoleController extends Controller
{
    public $columns = [
        ['data' => 'action', 'width' => '5%'],
        ['data' => 'role_name', 'width' => '25%'],
        ['data' => 'remark', 'width' => '50%'],
        
        ['data' => 'updated_at', 'width' => '10%']
    ];
    public  $meta = [ 
        'id'        => ['type'=> 'hidden','label'=>'ID' ],
        'role_name'      => ['type'=> 'text','label'=>'Name' ],
        'remark'      => ['type'=> 'textarea','label'=>'Desc' ],
        
        'created_at' => ['type'=> 'datetime','label'=>'CreatedAt' ],
        'created_by' => ['type'=> 'select2','label'=>'CreatedBy' ],
        'updated_at' => ['type'=> 'datetime','label'=>'UpdatedAt' ],
        'updated_by' => ['type'=> 'select2','label'=>'UpdatedBy' ]
    ];

    public $listShow = [
        'role_name'=>[], 
        'remark'=>[], 
        //'status_document'=>['enum'=>['draft','lock'],'enum_default'=>'draft'],
        'updated_at'=>[],
        //'updated_by'=>['related_table'=>'user','related_value'=>'name']
    ] ;

    public $createShow=[
        'id' =>['width'=> 'col-md-0'],
        'role_name'=>['width'=>'col-md-06'], 
        //'status_document'=>['width'=>'col-md-06','enum'=>['draft','locked'],'enum_default'=>'draft'],
        'remark'=>['width'=>'col-md-12'] , 
        
    ];

    public $detailShow=[
        'id' =>['width'=> 'col-md-0'],
        'role_name'=>['width'=> 'col-md-6'], 
        'remark'=>['width'=> 'col-md-12'] , 
        'created_at'=>['width'=> 'col-md-3'],
        'created_by'=>['width'=> 'col-md-3','related_table'=>'App\Models\User','related_value'=>'name'],
        'updated_at'=>['width'=> 'col-md-3'],
        'updated_by'=>['width'=> 'col-md-3','related_table'=>'App\Models\User','related_value'=>'name']
    ];
   
    public function index()
    {
        $roles = Role::all(); // Get all members
        return RoleResource::collection($roles); // Return resource collection
    }
    public function getData(Request $request)
    {
        // Fetch the data from the model
       // $members = Member::all(); // Adjust according to your needs
        $roles = Role::select([
            'id',
            'role_name', // Combine first and last name
            'remark',
            'created_at',
            'updated_at',
            'updated_by',
            'created_by'

        ])
        ->get();

        

        $s = datatables()->of($roles)
            ->editColumn('updated_at', function ($role) {
                $valueCol = $role->updated_at;
                //return $member->join_date;
                return view('PanelAdmin.component.datetime.view',compact('valueCol'));
            })
           
            ->addColumn('action', function ($role) {
                $route = 'role';
                $module_data = $role;
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
        $role = Role::find($id);
        if ($role) {
            $role->delete();
            return response()->json([
                'success' => true,
                'message' => 'Role deleted successfully!',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Role not found!',
            ], 404);
        }
    }
    public function edit(request $request,response $response,$id){
        $param = $request->input();
        unset($param['_token']);
        $param['id'] = $id;
        $param['updated_by']=Auth::User()->id;
        $role = Role::find($id);
        
        if ($role) {
            // Update the instructor's attributes
            $role->update($param);
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
            'role_name' => 'required|string|max:255',
            'remark' => 'max:255',
           
        ]);
        
        $role = Role::create([
            'role_name' => $validatedData['role_name'],
            'remark' => $validatedData['remark'],
            'updated_by'=> Auth::user()->id,
            'created_by'=> Auth::user()->id
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Role created successfully!',
            'role' => $role,
        ]);
    }
    public function create(request $request,response $response){
       // $PackageResource = PackageResource::collection(Package::find($id)->get())->toArray($request);
        $data = [];
        $config = [
                    'page'   => [
                        'title' => 'Role Create' ,
                        'description' => 'Role Create - Description',
                        'name' => 'Role Create',
                        'parent' => 'Roles',
                        'author' => 'Telcomixo',
                    ],
                    'module' => 'role',
                    'route'  => 'role',
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
        return view('PanelAdmin.Role.create',compact('config'));
    }

    public function detail(request $request,response $response,$id){
        $RoleResource = RoleResource::collection(Role::find($id)->get())->toArray($request);
        $data = $RoleResource;
        $config = [
                    'page'   => [
                        'title' => 'Role Detail - ID:'.$id ,
                        'description' => 'Role Detail - Description',
                        'name' => 'Role Detail - [ '.$data[0]['role_name'].'/'.$id.' ]',
                        'parent' => 'Role',
                        'author' => 'Telcomixo',
                    ],
                    
                    'module' => 'role',
                    'route'  => 'role',
                    'meta'=> H1BHelper::combine_based_on_second($this->meta,$this->detailShow),
                    'data' => $data,
                   

                ];
        return view('PanelAdmin.Role.detail',compact('config'));
    }
    
    public function list(request $request,response $response){

        $RoleResource = RoleResource::collection(Role::All())->toArray($request);
        $data = $RoleResource;
        $config = [
                    'page'   => [
                        'title' => 'Role List',
                        'description' => 'Role Listing - Description',
                        'name' => 'Listing Role',
                        'parent' => 'Roles',
                        'author' => 'Telcomixo',
                    ],
                    'module' => 'role',
                    'columns' => json_encode($this->columns,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                    'objModule'=> Role::All(),
                    'route'  => 'role',
                    'sort' =>"[[3, 'desc']]",
                    'meta'=> H1BHelper::combine_based_on_second($this->meta,$this->listShow),
                    'metaCreate'=> H1BHelper::combine_based_on_second($this->meta,$this->createShow),
                    'data' => $data,
                    'register_callback',
                    'button'=>[
                        'Export Excel'=>[
                            'name'=>'Export Excel',
                            'route'=>'role/create',
                            'icon'=>'ri-add-line'
                        ],
                        'Export PDF'=>[
                            'name'=>'Export Excel',
                            'route'=>'role/create',
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
      
        return view('PanelAdmin.Role.list',compact('config'));
    }
}
