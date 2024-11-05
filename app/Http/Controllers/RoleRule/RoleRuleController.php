<?php

namespace App\Http\Controllers\RoleRule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Resources\Role\RoleRuleResource;
use App\Models\Role\RoleRule;
use App\Models\Settings\MenuAdmin;

use App\Models\User;
use App\Helpers\H1BHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RoleRuleController extends Controller
{
    public $columns = [
        ['data' => 'action', 'width' => '5%'],
        ['data' => 'menu_id', 'width' => '25%'],
        ['data' => 'role_rule_name', 'width' => '50%'],
        ['data' => 'remark', 'width' => '50%'],
        //['data' => 'formula', 'width' => '50%'],
       // ['data' => 'status_document', 'width' => '50%'],
        ['data' => 'updated_at', 'width' => '10%']
    ];
    public  $meta = [ 
        'id'         => ['type'=> 'hidden','label'=>'ID' ],
        'menu_id'    => ['type'=> 'select2','label'=>'Menu' ],
        'role_rule_name'    => ['type'=> 'text','label'=>'Role Rule' ],
        'remark'            => ['type'=> 'textarea','label'=>'Remark' ],
       
        'created_at' => ['type'=> 'datetime','label'=>'CreatedAt' ],
        'created_by' => ['type'=> 'select2','label'=>'CreatedBy' ],
        'updated_at' => ['type'=> 'datetime','label'=>'UpdatedAt' ],
        'updated_by' => ['type'=> 'select2','label'=>'UpdatedBy' ]
    ];

    public $listShow = [
        'menu_id'=>[], 
        'role_rule_name'=>[], 
        'remark'=>[],
        //'formula'=>[],
        'updated_at'=>[],
    ] ;

    public $createShow=[
        'id' =>['width'=> 'col-md-0'],
        'menu_id'=>['width'=>'col-md-06','related_table'=>'App\Models\Settings\MenuAdmin','related_value'=>'menu_name'], 
        'role_rule_name'=>['width'=>'col-md-06'],
        'remark'=>['width'=>'col-md-12'],  
        
    ];

    public $detailShow=[
        'id' =>['width'=> 'col-md-0'],
        'menu_id'=>['width'=> 'col-md-6','related_table'=>'App\Models\Settings\MenuAdmin','related_value'=>'menu_name'], 
        'role_rule_name'=>['width'=> 'col-md-6'] , 
        'remark'=>['width'=> 'col-md-12'] , 
       
        
        'created_at'=>['width'=> 'col-md-3'],
        'created_by'=>['width'=> 'col-md-3','related_table'=>'App\Models\User','related_value'=>'name'],
        'updated_at'=>['width'=> 'col-md-3'],
        'updated_by'=>['width'=> 'col-md-3','related_table'=>'App\Models\User','related_value'=>'name']
    ];
   
    public function index()
    {
        $RoleRule = RoleRule::all(); // Get all members
        return RoleRuleResource::collection($RoleRule); // Return resource collection
    }
    public function getData(Request $request)
    {
        // Fetch the data from the model
       // $members = Member::all(); // Adjust according to your needs
        $role_rules = RoleRule::select([
            'id',
            'menu_id', // Combine first and last name
            'role_rule_name',
            'remark',
            'created_at',
            'updated_at',
            'updated_by',
            'created_by'

        ])
        ->get();

        

        $s = datatables()->of($role_rules)
            ->editColumn('updated_at', function ($role_rule) {
                $valueCol = $role_rule->updated_at;
                //return $member->join_date;
                return view('PanelAdmin.component.datetime.view',compact('valueCol'));
            })
            ->editColumn('menu_id', function ($role_rule) {
                $menu = MenuAdmin::find($role_rule->menu_id);
                $valueCol = $menu->menu_name;
                //return $member->join_date;
                return view('PanelAdmin.component.text.view',compact('valueCol'));
            })
            ->addColumn('action', function ($role_rule) {
                $route = 'RoleRule';
                $module_data = $role_rule;
                return view('PanelAdmin.component.action_grid.view', compact('module_data','route')); // Create a Blade view for action buttons
               // return '';
            })
            ->make(true);
       return $s;
     
    }
    public function delete(request $request,response $response){
        $id = $request->id;
        $RoleRule = RoleRule::find($id);
        if ($RoleRule) {
            $RoleRule->delete();
            return response()->json([
                'success' => true,
                'message' => 'RoleRule deleted successfully!',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'RoleRule not found!',
            ], 404);
        }
    }
    public function edit(request $request,response $response,$id){
        $param = $request->input();
        unset($param['_token']);
        $param['id'] = $id;
        $param['updated_by']=Auth::User()->id;
        $RoleRule = RoleRule::find($id);
        
        if ($RoleRule) {
            // Update the instructor's attributes
            $RoleRule->update($param);
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
            'menu_id' => 'required',
            'role_rule_name' => 'required|string|max:255'
        ]);
        
        $RoleRule = RoleRule::create([
            'menu_id' => $validatedData['menu_id'],
            'role_rule_name' => $validatedData['role_rule_name'],
            'remark' => $request->input('remark'),
        
            'updated_by'=> Auth::user()->id,
            'created_by'=> Auth::user()->id
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Role Rule created successfully!',
            'RoleRule' => $RoleRule,
        ]);
    }
    public function create(request $request,response $response){
      
        $data = [];
        $config = [
                    'page'   => [
                        'title' => 'Role Rule Create' ,
                        'description' => 'Role Rule Create - Description',
                        'name' => 'Role Rule Create',
                        'parent' => 'Roles Rules',
                        'author' => 'Telcomixo',
                    ],
                    'module' => 'RoleRule',
                    'route'  => 'RoleRule',
                    'meta'=> H1BHelper::combine_based_on_second($this->meta,$this->createShow),
                    'data' => $data,
                    'relation'=>[],

                ];
        return view('PanelAdmin.RoleRule.create',compact('config'));
    }

    public function detail(request $request,response $response,$id){
        $RoleRuleResource = RoleRuleResource::collection(RoleRule::find($id)->get())->toArray($request);
        $data = $RoleRuleResource;
        $config = [
                    'page'   => [
                        'title' => 'Role Rule Detail - ID:'.$id ,
                        'description' => 'Role Rule Detail - Description',
                        'name' => 'Role Rule Detail - [ '.$data[0]['name'].'/'.$id.' ]',
                        'parent' => 'Role Rule',
                        'author' => 'Telcomixo',
                    ],
                    'id'=>$id,
                    'module' => 'RoleRule',
                    'route'  => 'RoleRule',
                    'meta'=> H1BHelper::combine_based_on_second($this->meta,$this->detailShow),
                    'data' => $data,
                   

                ];
        return view('PanelAdmin.RoleRule.detail',compact('config'));
    }
    
    public function list(request $request,response $response){

        $RoleRuleResource = RoleRuleResource::collection(RoleRule::All())->toArray($request);
        $data = $RoleRuleResource;
        $config = [
                    'page'   => [
                        'title' => 'Role Rule List',
                        'description' => 'Role Rule Listing - Description',
                        'name' => 'Listing Role Rule',
                        'parent' => 'Role Rules',
                        'author' => 'Telcomixo',
                    ],
                    'module' => 'RoleRule',
                    'columns' => json_encode($this->columns,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                    'objModule'=> RoleRule::All(),
                    'route'  => 'RoleRule',
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
      
        return view('PanelAdmin.RoleRule.list',compact('config'));
    }
}
