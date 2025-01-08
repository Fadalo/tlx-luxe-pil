<?php

namespace App\Http\Controllers\Theme;

use Illuminate\Http\Request;
use Illuminate\Http\Response; 
use App\Http\Controllers\Controller; 
use App\Http\Resources\Theme\ThemeResource;
use App\Models\Theme\Theme;
use App\Models\User;
use App\Helpers\H1BHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ThemeController extends Controller
{
    public $columns = [
        ['data' => 'action', 'width' => '5%'],
     
        ['data' => 'id2', 'width' => '5%'],
        ['data' => 'name', 'width' => '80%'],
       // ['data' => 'templete', 'width' => '30%'],
        
        ['data' => 'updated_at', 'width' => '10%']
    ];
    public  $meta = [ 
        'id'          => ['type'=> 'hidden','label'=>'ID' ],
        'id2'          => ['type'=> 'text','label'=>'ID' ],
        
        'name'        => ['type'=> 'text','label'=>'Name' ],
        
        'created_at' => ['type'=> 'datetime','label'=>'CreatedAt' ],
        'created_by' => ['type'=> 'select2','label'=>'CreatedBy' ],
        'updated_at' => ['type'=> 'datetime','label'=>'UpdatedAt' ],
        'updated_by' => ['type'=> 'select2','label'=>'UpdatedBy' ]
    ];

    public $listShow = [
        
        'id2'=>[],
        'name'=>[], 
      //  'templete'=>[], 
        //'status_document'=>['enum'=>['draft','lock'],'enum_default'=>'draft'],
        'updated_at'=>[],
        //'updated_by'=>['related_table'=>'user','related_value'=>'name']
    ] ;

    public $createShow=[
        'id' =>['width'=> 'col-md-0'],
        'name'=>['width'=>'col-md-12'], 
        
        //'status_document'=>['width'=>'col-md-06','enum'=>['draft','locked'],'enum_default'=>'draft'],
       
        
    ];

    public $detailShow=[
        'id' =>['width'=> 'col-md-0'],
        'name'=>['width'=> 'col-md-12'] , 
        
        'created_at'=>['width'=> 'col-md-3'],
        'created_by'=>['width'=> 'col-md-3','related_table'=>'App\Models\User','related_value'=>'name'],
        'updated_at'=>['width'=> 'col-md-3'],
        'updated_by'=>['width'=> 'col-md-3','related_table'=>'App\Models\User','related_value'=>'name']
    ];
   
    public function index()
    {
        $Autoresponse = Autoresponse::all(); // Get all members
        return AutoresponseResource::collection($Autoresponse); // Return resource collection
    }
    public function getData(Request $request)
    {
        // Fetch the data from the model
       // $members = Member::all(); // Adjust according to your needs
        $Themes = Theme::select([
            'id',
            'id as id2',
            'name',
            'created_at',
            'updated_at',
            'updated_by',
            'created_by'

        ])
        ->get();

        

        $s = datatables()->of($Themes)
            ->editColumn('updated_at', function ($Theme) {
                $valueCol = $Theme->updated_at;
                //return $member->join_date;
                return view('PanelAdmin.component.datetime.view',compact('valueCol'));
            })
           
            ->addColumn('action', function ($Theme) {
                $route = 'Theme';
                $module_data = $Theme;
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
        $Theme = Theme::find($id);
        if ($Theme) {
            $Theme->delete();
            return response()->json([
                'success' => true,
                'message' => 'Theme deleted successfully!',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Theme not found!',
            ], 404);
        }
    }
    public function edit(request $request,response $response,$id){
        $param = $request->input();
        unset($param['_token']);
        $param['id'] = $id;
        $param['updated_by']=Auth::User()->id;
        $Theme = Theme::find($id);
        
        if ($Theme) {
            // Update the instructor's attributes
            $Theme->update($param);
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
            'name' => 'required',
          
            
           
        ]);
        
        $Theme = Theme::create([
            'name' => $validatedData['name'],
            'updated_by'=> Auth::user()->id,
            'created_by'=> Auth::user()->id
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Theme created successfully!',
            'Theme' => $Theme,
        ]);
    }
    public function create(request $request,response $response){
       // $PackageResource = PackageResource::collection(Package::find($id)->get())->toArray($request);
        $data = [];
        $config = [
                    'page'   => [
                        'title' => 'Theme Create' ,
                        'description' => 'Theme Create - Description',
                        'name' => 'Theme Create',
                        'parent' => 'Theme',
                        'author' => 'Telcomixo',
                    ],
                    'module' => 'theme',
                    'route'  => 'theme',
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
        return view('PanelAdmin.Theme.create',compact('config'));
    }

    public function detail(request $request,response $response,$id){
        $ThemeResource = ThemeResource::collection(Theme::find($id)->get())->toArray($request);
        $data = $ThemeResource;
        $config = [
                    'page'   => [
                        'title' => 'Theme Detail - ID:'.$id ,
                        'description' => 'Theme Detail - Description',
                        'name' => 'Theme Detail - [ '.$data[0]['name'].'/'.$id.' ]',
                        'parent' => 'Theme',
                        'author' => 'Telcomixo',
                    ],
                    'id'=>$id,
                    'module' => 'theme',
                    'route'  => 'theme',
                    'meta'=> H1BHelper::combine_based_on_second($this->meta,$this->detailShow),
                    'data' => $data,
                   

                ];
        return view('PanelAdmin.Theme.detail',compact('config'));
    }
    
    public function list(request $request,response $response){

        $ThemeResource = ThemeResource::collection(Theme::All())->toArray($request);
     
        $prevMonthCount = Theme::where('created_at','<', Carbon::now()->subMonthsNoOverflow()->endOfMonth()->toDateString())->count();
       
        $totalCount = Theme::All()->count();
        if($totalCount == 0){
            $percentageTheme = 0;
        }else{
            $percentageTheme = (($totalCount-$prevMonthCount)/$totalCount)*100;
        }
        
      //  dd($percentageAutoreponse);
        $data = $ThemeResource;
        $config = [
                    'page'   => [
                        'title' => 'Theme List',
                        'description' => 'Theme Listing - Description',
                        'name' => 'Listing Theme',
                        'parent' => 'Theme',
                        'author' => 'Telcomixo',
                    ],
                    'module' => 'theme',
                    
                    'columns' => json_encode($this->columns,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                    'objModule'=> Theme::All(),
                    'route'  => 'theme',
                    'sort' =>"[[2, 'desc']]",
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
                        'Total Theme'   => [
                            'name'=> 'Total Theme',
                            'width' =>'col-md-12',
                            'icon'=> 'ri-user-3-line font-size-24',
                            'width'=>'col-md-12',
                            'module'=> 'theme',
                            'count-value'=> $totalCount,
                            'percentage-value'=>  H1BHelper::isHasDecimal($percentageTheme).'%',                            
                                                       
                            'render'=> '',
                            'onClick'=> ''
                        ],
                       
                       
                        
                    ]
                ];
      
        return view('PanelAdmin.Theme.list',compact('config'));
    }
}
