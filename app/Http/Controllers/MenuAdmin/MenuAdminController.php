<?php

namespace App\Http\Controllers\MenuAdmin;

use Illuminate\Http\Request;
use Illuminate\Http\Response; 
use App\Http\Controllers\Controller; 
use App\Http\Resources\MenuAdmin\MenuAdminResource;
use App\Models\Settings\MenuAdmin;
use App\Models\User;
use App\Helpers\H1BHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MenuAdminController extends Controller
{            
    public $columns = [
        ['data' => 'action', 'width' => '5%'],
        ['data' => 'menu_type', 'width' => '25%'],
        ['data' => 'menu_name', 'width' => '50%'],
        ['data' => 'menu_controller', 'width' => '50%'],
        ['data' => 'menu_route', 'width' => '50%'],
        ['data' => 'menu_icon', 'width' => '50%'],
        ['data' => 'parent_id', 'width' => '50%'],
        ['data' => 'remark', 'width' => '50%'],     
        ['data' => 'updated_at', 'width' => '10%']
    ];
   
    public  $meta = [ 
        'id'                => ['type'=> 'hidden','label'=>'ID' ],
        'menu_type'         => ['type'=> 'dropdown','label'=>'MenuType'],
        'menu_name'         => ['type'=> 'text','label'=>'MenuName' ],
        'menu_controller'   => ['type'=> 'text','label'=>'MenuController' ],
        'menu_route'        => ['type'=> 'text','label'=>'MenuRoute' ],
        'menu_icon'         => ['type'=> 'text','label'=>'MenuIcon' ],
        'parent_id'       => ['type'=> 'select2','label'=>'Parent'  ],
        'remark'            => ['type'=> 'textarea','label'=>'Remark' ],
        
        'created_at' => ['type'=> 'datetime','label'=>'CreatedAt' ],
        'created_by' => ['type'=> 'select2','label'=>'CreatedBy' ],
        'updated_at' => ['type'=> 'datetime','label'=>'UpdatedAt' ],
        'updated_by' => ['type'=> 'select2','label'=>'UpdatedBy' ]
    ];

    public $listShow = [
        'menu_type'=>[], 
        'menu_name'=>[], 
        'menu_controller'=>[], 
        'menu_route'=>[], 
        'menu_icon'=>[], 
        'parent_id'=>[], 
        'remark'=>[], 
        
        //'status_document'=>['enum'=>['draft','lock'],'enum_default'=>'draft'],
        'updated_at'=>[],
        //'updated_by'=>['related_table'=>'user','related_value'=>'name']
    ] ;

 
    public $createShow=[
        'id' =>['width'=> 'col-md-0'],
        'parent_id'=>['width'=>'col-md-06','related_table'=>'App\Models\Settings\MenuAdmin','related_value'=>'menu_name'],
        'menu_name'=>['width'=>'col-md-12'], 
        'menu_type'=>['width'=>'col-md-12','enum'=>['header','content'],'enum_default'=>'content'], 
        
        'menu_controller'=>['width'=>'col-md-06'], 
        'menu_route'=>['width'=>'col-md-06'], 
        'menu_icon'=>['width'=>'col-md-06'],
        'remark'=>['width'=>'col-md-12'],
          
    ];

    public $detailShow=[
       'id' =>['width'=> 'col-md-0'],
        'menu_type'=>['width'=>'col-md-6','enum'=>['header','content'],'enum_default'=>'content'], 
        'parent_id'=>['width'=>'col-md-6','related_table'=>'App\Models\Settings\MenuAdmin','related_value'=>'menu_name'],
        
        'menu_name'=>['width'=>'col-md-12'], 
        
        'menu_controller'=>['width'=>'col-md-4'], 
        'menu_route'=>['width'=>'col-md-4'], 
        'menu_icon'=>['width'=>'col-md-4'],
        'remark'=>['width'=>'col-md-12'],
        'created_at'=>['width'=> 'col-md-3'],
        'created_by'=>['width'=> 'col-md-3','related_table'=>'App\Models\User','related_value'=>'name'],
        'updated_at'=>['width'=> 'col-md-3'],
        'updated_by'=>['width'=> 'col-md-3','related_table'=>'App\Models\User','related_value'=>'name']
    ];
   
    public function index()
    {
        $MenuAdmins = MenuAdmin::all(); // Get all members
        return MenuAdminResource::collection($MenuAdmins); // Return resource collection
    }
    public function getData(Request $request)
    {
        // Fetch the data from the model
       // $members = Member::all(); // Adjust according to your needs
        $MenuAdmins = MenuAdmin::select([
            'id',
            'parent_id', // Combine first and last name
            'menu_name',
            'menu_route',
            'menu_type',
            'menu_controller',
            'menu_icon',
            'remark',
           
            
            'created_at',
            'updated_at',
            'updated_by',
            'created_by'

        ])
        ->get();

        

        $s = datatables()->of($MenuAdmins)
            ->editColumn('updated_at', function ($menuAdmin) {
                $valueCol = $menuAdmin->updated_at;
                //return $member->join_date;
                return view('PanelAdmin.component.datetime.view',compact('valueCol'));
            })
           
            ->addColumn('action', function ($menuAdmin) {
                $route = 'MenuAdmin';
                $module_data = $menuAdmin;
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
        $menuAdmin = MenuAdmin::find($id);
        if ($menuAdmin) {
            $menuAdmin->delete();
            return response()->json([
                'success' => true,
                'message' => 'Menu deleted successfully!',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Menu not found!',
            ], 404);
        }
    }
    public function edit(request $request,response $response,$id){
        $param = $request->input();
        unset($param['_token']);
        $param['id'] = $id;
        $param['updated_by']=Auth::User()->id;
        $menuAdmin = MenuAdmin::find($id);
        
        if ($menuAdmin) {
            // Update the instructor's attributes
            $menuAdmin->update($param);
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
           
            'menu_name' => 'required|string|max:255',
            'menu_type' => 'required|string|max:255',
            'menu_route'=> 'required|string|max:255',
            'menu_controller' => 'required|string|max:255',
            'menu_icon' => 'required|string|max:255',
            'remark' => 'required|string|max:255',

        ]);
  
        $parent_id = ($request->input('parent_id') == '')? '0' : $request->input('parent_id');
        $menuAdmin = MenuAdmin::create([
            'parent_id' => $parent_id,
            'menu_name' => $validatedData['menu_name'],
            'menu_type' => $validatedData['menu_type'],
            'menu_route' => $validatedData['menu_route'],
            
            'menu_controller' => $validatedData['menu_controller'],
            'menu_icon' => $validatedData['menu_icon'],
            'remark' => $validatedData['remark'],
            
            'updated_by'=> Auth::user()->id,
            'created_by'=> Auth::user()->id
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Menu created successfully!',
            'package' => $package,
        ]);
    }
    public function create(request $request,response $response){
       // $PackageResource = PackageResource::collection(Package::find($id)->get())->toArray($request);
        $data = [];
        $config = [
                    'page'   => [
                        'title' => 'Menu Admin Create' ,
                        'description' => 'Menu Admin Create - Description',
                        'name' => 'Menu Admin Create',
                        'parent' => 'Menu Admin',
                        'author' => 'Telcomixo',
                    ],
                    'module' => 'MenuAdmin',
                    'route'  => 'MenuAdmin',
                    'meta'=> H1BHelper::combine_based_on_second($this->meta,$this->createShow),
                    'data' => $data,
                    'relation'=>[],
                       
                        
                        
                    

                ];
        return view('PanelAdmin.MenuAdmin.create',compact('config'));
    }

    public function detail(request $request,response $response,$id){
        $MenuAdminResource = MenuAdminResource::collection(MenuAdmin::where('id',$id)->get())->toArray($request);
        $data = $MenuAdminResource;
        $config = [
                    'page'   => [
                        'title' => 'MenuAdmin Detail - ID:'.$id ,
                        'description' => 'MenuAdmin Detail - Description',
                        'name' => 'MenuAdmin Detail - [ '.$data[0]['menu_name'].'/'.$id.' ]',
                        'parent' => 'MenuAdmin',
                        'author' => 'Telcomixo',
                    ],
                    'id'=>$id,
                    'module' => 'MenuAdmin',
                    'route'  => 'MenuAdmin',
                    'meta'=> H1BHelper::combine_based_on_second($this->meta,$this->detailShow),
                    'data' => $data,
                    'relation'=>[ ]

                ];
        return view('PanelAdmin.MenuAdmin.detail',compact('config'));
    }
    
    public function list(request $request,response $response){

        $MenuAdminResource = MenuAdminResource::collection(MenuAdmin::All())->toArray($request);
        $data = $MenuAdminResource;
        $config = [
                    'page'   => [
                        'title' => 'MenuAdmin List',
                        'description' => 'MenuAdmin Listing - Description',
                        'name' => 'Listing MenuAdmin',
                        'parent' => 'MenuAdmin',
                        'author' => 'Telcomixo',
                    ],
                    'module' => 'MenuAdmin',
                    'columns' => json_encode($this->columns,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                    'objModule'=> MenuAdmin::All(),
                    'route'  => 'MenuAdmin',
                    'sort' =>"[[7, 'desc']]",
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
                    
                    'stat'=>[]
                ];
      
        return view('PanelAdmin.MenuAdmin.list',compact('config'));
    }
}
