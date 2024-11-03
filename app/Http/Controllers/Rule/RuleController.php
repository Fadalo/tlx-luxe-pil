<?php

namespace App\Http\Controllers\Rule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Resources\Rule\RuleResource;
use App\Models\Package\Rule;
use App\Models\User;
use App\Helpers\H1BHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RuleController extends Controller
{
    public $columns = [
        ['data' => 'action', 'width' => '5%'],
        ['data' => 'name', 'width' => '25%'],
        ['data' => 'remark', 'width' => '50%'],
        //['data' => 'function', 'width' => '50%'],
        //['data' => 'formula', 'width' => '50%'],
       // ['data' => 'status_document', 'width' => '50%'],
        ['data' => 'updated_at', 'width' => '10%']
    ];
    public  $meta = [ 
        'id'                => ['type'=> 'hidden','label'=>'ID' ],
        'name'              => ['type'=> 'text','label'=>'Name' ],
        'remark'            => ['type'=> 'textarea','label'=>'Remark' ],
        'function'          => ['type'=> 'text','label'=>'Function' ],
        'formula'           => ['type'=> 'query_builder','label'=>'Formula' ],
        //'status_document'   => ['type'=> 'textarea','label'=>'Status Document' ],
        
        'created_at' => ['type'=> 'datetime','label'=>'CreatedAt' ],
        'created_by' => ['type'=> 'select2','label'=>'CreatedBy' ],
        'updated_at' => ['type'=> 'datetime','label'=>'UpdatedAt' ],
        'updated_by' => ['type'=> 'select2','label'=>'UpdatedBy' ]
    ];

    public $listShow = [
        'name'=>[], 
        'remark'=>[], 
        //'function'=>[],
        //'formula'=>[],
        'updated_at'=>[],
    ] ;

    public $createShow=[
        'id' =>['width'=> 'col-md-0'],
        'name'=>['width'=>'col-md-06'], 
        'function'=>['width'=>'col-md-06'],
        'remark'=>['width'=>'col-md-12'], 
        'formula'=>['width'=>'col-md-12'], 
        
    ];

    public $detailShow=[
        'id' =>['width'=> 'col-md-0'],
        'name'=>['width'=> 'col-md-6'], 
        'function'=>['width'=> 'col-md-6'] , 
        'remark'=>['width'=> 'col-md-12'] , 
        'formula'=>['width'=> 'col-md-12'] , 
        
        'created_at'=>['width'=> 'col-md-3'],
        'created_by'=>['width'=> 'col-md-3','related_table'=>'App\Models\User','related_value'=>'name'],
        'updated_at'=>['width'=> 'col-md-3'],
        'updated_by'=>['width'=> 'col-md-3','related_table'=>'App\Models\User','related_value'=>'name']
    ];
   
    public function index()
    {
        $rules = Rule::all(); // Get all members
        return RuleResource::collection($rules); // Return resource collection
    }
    public function getData(Request $request)
    {
        // Fetch the data from the model
       // $members = Member::all(); // Adjust according to your needs
        $rules = Rule::select([
            'id',
            'name', // Combine first and last name
            'remark',
            'function',
            'formula',
            'status_document',
            'created_at',
            'updated_at',
            'updated_by',
            'created_by'

        ])
        ->get();

        

        $s = datatables()->of($rules)
            ->editColumn('updated_at', function ($rule) {
                $valueCol = $rule->updated_at;
                //return $member->join_date;
                return view('PanelAdmin.component.datetime.view',compact('valueCol'));
            })
           
            ->addColumn('action', function ($rule) {
                $route = 'rule';
                $module_data = $rule;
                return view('PanelAdmin.component.action_grid.view', compact('module_data','route')); // Create a Blade view for action buttons
               // return '';
            })
            ->make(true);
       return $s;
     
    }
    public function delete(request $request,response $response){
        $id = $request->id;
        $rule = Rule::find($id);
        if ($rule) {
            $rule->delete();
            return response()->json([
                'success' => true,
                'message' => 'Rule deleted successfully!',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Rule not found!',
            ], 404);
        }
    }
    public function edit(request $request,response $response,$id){
        $param = $request->input();
        unset($param['_token']);
        $param['id'] = $id;
        $param['updated_by']=Auth::User()->id;
        $rule = Rule::find($id);
        
        if ($rule) {
            // Update the instructor's attributes
            $rule->update($param);
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
            'name' => 'required|string|max:255',
            'remark' => 'required|string',
            'function' => 'required|string',
            'formula' => 'required|string',
            
           
        ]);
        
        $rule = Rule::create([
            'name' => $validatedData['name'],
            'remark' => $validatedData['remark'],
            'function' => $validatedData['function'],
            'formula' => $validatedData['formula'],
            
            'updated_by'=> Auth::user()->id,
            'created_by'=> Auth::user()->id
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Rule created successfully!',
            'role' => $role,
        ]);
    }
    public function create(request $request,response $response){
      
        $data = [];
        $config = [
                    'page'   => [
                        'title' => 'Package Rule Create' ,
                        'description' => 'Package Rule Create - Description',
                        'name' => 'Package Rule Create',
                        'parent' => 'Rules',
                        'author' => 'Telcomixo',
                    ],
                    'module' => 'rule',
                    'route'  => 'rule',
                    'meta'=> H1BHelper::combine_based_on_second($this->meta,$this->createShow),
                    'data' => $data,
                    'relation'=>[],

                ];
        return view('PanelAdmin.Rule.create',compact('config'));
    }

    public function detail(request $request,response $response,$id){
        $RuleResource = RuleResource::collection(Rule::find($id)->get())->toArray($request);
        $data = $RuleResource;
        $config = [
                    'page'   => [
                        'title' => 'Package Rule Detail - ID:'.$id ,
                        'description' => 'Package Rule Detail - Description',
                        'name' => 'Package Rule Detail - [ '.$data[0]['name'].'/'.$id.' ]',
                        'parent' => 'Rule',
                        'author' => 'Telcomixo',
                    ],
                    'id'=>$id,
                    'module' => 'rule',
                    'route'  => 'rule',
                    'meta'=> H1BHelper::combine_based_on_second($this->meta,$this->detailShow),
                    'data' => $data,
                   

                ];
        return view('PanelAdmin.Rule.detail',compact('config'));
    }
    
    public function list(request $request,response $response){

        $RuleResource = RuleResource::collection(Rule::All())->toArray($request);
        $data = $RuleResource;
        $config = [
                    'page'   => [
                        'title' => 'Package Rule List',
                        'description' => 'Package Rule Listing - Description',
                        'name' => 'Listing Package Rule',
                        'parent' => 'Package Rules',
                        'author' => 'Telcomixo',
                    ],
                    'module' => 'rule',
                    'columns' => json_encode($this->columns,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                    'objModule'=> Rule::All(),
                    'route'  => 'rule',
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
      
        return view('PanelAdmin.Rule.list',compact('config'));
    }
}
