<?php

namespace App\Http\Controllers\Watem;

use Illuminate\Http\Request;
use Illuminate\Http\Response; 
use App\Http\Controllers\Controller; 
use App\Http\Resources\Watem\WatemResource;
use App\Models\Watem\Watem;
use App\Models\User;
use App\Helpers\H1BHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WatemController extends Controller
{
    public $columns = [
        ['data' => 'action', 'width' => '5%'],
        ['data' => 'module', 'width' => '25%'],
        ['data' => 'name', 'width' => '25%'],
        ['data' => 'templete', 'width' => '50%'],
        
        ['data' => 'updated_at', 'width' => '10%']
    ];
    public  $meta = [ 
        'id'          => ['type'=> 'hidden','label'=>'ID' ],
        'module'      => ['type'=> 'text','label'=>'Module' ],
        'name'        => ['type'=> 'text','label'=>'Name' ],
        'templete'    => ['type'=> 'textarea','label'=>'Template' ],
        
        'created_at' => ['type'=> 'datetime','label'=>'CreatedAt' ],
        'created_by' => ['type'=> 'select2','label'=>'CreatedBy' ],
        'updated_at' => ['type'=> 'datetime','label'=>'UpdatedAt' ],
        'updated_by' => ['type'=> 'select2','label'=>'UpdatedBy' ]
    ];

    public $listShow = [
        'module'=>[], 
        'name'=>[], 
        'templete'=>[], 
        
        
        //'status_document'=>['enum'=>['draft','lock'],'enum_default'=>'draft'],
        'updated_at'=>[],
        //'updated_by'=>['related_table'=>'user','related_value'=>'name']
    ] ;

    public $createShow=[
        'id' =>['width'=> 'col-md-0'],
        'module'=>['width'=>'col-md-6'], 
        'name'=>['width'=>'col-md-6'], 
        'templete'=>['width'=>'col-md-12'], 
        
        //'status_document'=>['width'=>'col-md-06','enum'=>['draft','locked'],'enum_default'=>'draft'],
       
        
    ];

    public $detailShow=[
        'id' =>['width'=> 'col-md-0'],
        'module'=>['width'=> 'col-md-6'], 
        'name'=>['width'=> 'col-md-6'] , 
        'templete'=>['width'=> 'col-md-12'] , 
        
        'created_at'=>['width'=> 'col-md-3'],
        'created_by'=>['width'=> 'col-md-3','related_table'=>'App\Models\User','related_value'=>'name'],
        'updated_at'=>['width'=> 'col-md-3'],
        'updated_by'=>['width'=> 'col-md-3','related_table'=>'App\Models\User','related_value'=>'name']
    ];
   
    public function index()
    {
        $Watem = Watem::all(); // Get all members
        return WatemResource::collection($Watem); // Return resource collection
    }
    public function getData(Request $request)
    {
        // Fetch the data from the model
       // $members = Member::all(); // Adjust according to your needs
        $Watems = Watem::select([
            'id',
            'module', // Combine first and last name
            'name',
            'templete',
            
            'created_at',
            'updated_at',
            'updated_by',
            'created_by'

        ])
        ->get();

        

        $s = datatables()->of($Watems)
            ->editColumn('updated_at', function ($Watem) {
                $valueCol = $Watem->updated_at;
                //return $member->join_date;
                return view('PanelAdmin.component.datetime.view',compact('valueCol'));
            })
           
            ->addColumn('action', function ($Watem) {
                $route = 'Watem';
                $module_data = $Watem;
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
        $Watem = Watem::find($id);
        if ($Watem) {
            $Watem->delete();
            return response()->json([
                'success' => true,
                'message' => 'Template deleted successfully!',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Template not found!',
            ], 404);
        }
    }
    public function edit(request $request,response $response,$id){
        $param = $request->input();
        unset($param['_token']);
        $param['id'] = $id;
        $param['updated_by']=Auth::User()->id;
        $Watem = Watem::find($id);
        
        if ($Watem) {
            // Update the instructor's attributes
            $Watem->update($param);
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
            'module' => 'required',
            'name' => 'required',
           
        ]);
        
        $Watem = Watem::create([
            'module' => $validatedData['module'],
            'name' => $validatedData['type'],
            'templete' => $validatedData['templete'],
            'updated_by'=> Auth::user()->id,
            'created_by'=> Auth::user()->id
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Template created successfully!',
            'Watem' => $Watem,
        ]);
    }
    public function create(request $request,response $response){
       // $PackageResource = PackageResource::collection(Package::find($id)->get())->toArray($request);
        $data = [];
        $config = [
                    'page'   => [
                        'title' => 'Template Create' ,
                        'description' => 'Template Create - Description',
                        'name' => 'Templete Create',
                        'parent' => 'Wa Template',
                        'author' => 'Telcomixo',
                    ],
                    'module' => 'watem',
                    'route'  => 'watem',
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
        return view('PanelAdmin.Watem.create',compact('config'));
    }

    public function detail(request $request,response $response,$id){
        $WatemResource = WatemResource::collection(Watem::find($id)->get())->toArray($request);
        $data = $WatemResource;
        $config = [
                    'page'   => [
                        'title' => 'Wa Template Detail - ID:'.$id ,
                        'description' => 'Wa Template Detail - Description',
                        'name' => 'Wa Template Detail - [ '.$data[0]['module'].'/'.$id.' ]',
                        'parent' => 'Wa Template',
                        'author' => 'Telcomixo',
                    ],
                    'id'=>$id,
                    'module' => 'watem',
                    'route'  => 'watem',
                    'meta'=> H1BHelper::combine_based_on_second($this->meta,$this->detailShow),
                    'data' => $data,
                   

                ];
        return view('PanelAdmin.Watem.detail',compact('config'));
    }
    
    public function list(request $request,response $response){

        $WatemResource = WatemResource::collection(Watem::All())->toArray($request);
        $prevMonthCount = Watem::where('created_at','<', Carbon::now()->subMonthsNoOverflow()->endOfMonth()->toDateString())->count();
        $totalCount = Watem::All()->count();
        $percentageWatem = (($totalCount-$prevMonthCount)/$totalCount)*100;
        $data = $WatemResource;
        $config = [
                    'page'   => [
                        'title' => 'Wa Template List',
                        'description' => 'Wa Template Listing - Description',
                        'name' => 'Listing Wa Templete',
                        'parent' => 'Wa Template',
                        'author' => 'Telcomixo',
                    ],
                    'module' => 'watem',
                    
                    'columns' => json_encode($this->columns,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                    'objModule'=> Watem::All(),
                    'route'  => 'watem',
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
                        'Total Templete'   => [
                            'name'=> 'Total Templete',
                            'width' =>'col-md-12',
                            'icon'=> 'ri-user-3-line font-size-24',
                            'width'=>'col-md-12',
                            'module'=> 'Watem',
                            'count-value'=> $totalCount,
                            'percentage-value'=>  H1BHelper::isHasDecimal($percentageWatem).'%',                            
                                                       
                            'render'=> '',
                            'onClick'=> ''
                        ],
                       
                       
                        
                    ]
                ];
      
        return view('PanelAdmin.Watem.list',compact('config'));
    }
}
