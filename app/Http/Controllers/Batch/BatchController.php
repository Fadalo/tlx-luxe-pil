<?php

namespace App\Http\Controllers\Batch;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Resources\Batch\BatchResource;

use App\Http\Resources\UserResource;
use App\Models\Batch\Batch;
use App\Models\Member\Member;

use App\Models\Instructor\Instructor;
use App\Models\Package\Package;

use App\Models\User;
use App\Helpers\H1BHelper;
use Carbon\Carbon; 

use Illuminate\Support\Facades\Auth;
class BatchController extends Controller
{
    public $columns = [
        ['data' => 'action', 'width' => '5%'],
        ['data' => 'name', 'width' => '35%'],
       // ['data' => 'remark', 'width' => '30%'],
        ['data' => 'instructor_id', 'width' => '10%'],
        ['data' => 'package_id', 'width' => '10%'],
        ['data' => 'start_datetime', 'width' => '10%'],
        ['data' => 'qty_max', 'width' => '10%'],
        
        ['data' => 'updated_at', 'width' => '10%']
        
    ];
 
    public  $meta = [ 
        'id'            => ['type'=> 'hidden','label'=> 'ID'],
        'name'          => ['type'=> 'text','label'=> 'Batch'],
        'remark'        => ['type'=> 'textarea','label'=> 'Remark'],
        'status'        => ['type'=> 'dropdown','label'=> 'Status'],
        'instructor_id' => ['type'=> 'select2','label'=> 'Instructor'],
        'package_id'    => ['type'=> 'select2','label'=> 'Package'],
        'start_datetime'       => ['type'=> 'datetime','label'=> 'Start Date'],
        'end_datetime'     => ['type'=> 'datetime','label'=> 'End Date'],
        'status_document' => ['type'=> 'dropdown','label'=> 'Status Document'],
        'qty_book'     => ['type'=> 'number','label'=> 'QtyBook'],
        'qty_max' => ['type'=> 'number','label'=> 'QtyMax'],
        
        'created_at' => ['type'=> 'datetime','label'=> 'Created At'],
        'created_by' => ['type'=> 'select2','label'=> 'Created By'],
        'updated_at' => ['type'=> 'datetime','label'=> 'Updated At'],
        'updated_by' => ['type'=> 'select2','label'=> 'Updated By']
];

public $listShow = [

    'name'                => [],
   // 'remark'              => [],
   // 'status'              => [],
    'instructor_id '      => ['label'=>'Instructor'],
    'package_id '         => ['label'=>'Package'],
    'start_datetime'      => ['label'=>'Date'],
    'qty_max' => ['label'=>'Qty Available'],
    //'end_datetime'        => [],
    //'status_document'     => [],
    //'status_document'=>['enum'=>['draft','lock'],'enum_default'=>'draft'],
    'updated_at'=>[],
    //'updated_by'=>['related_table'=>'user','related_value'=>'name']
];

public $createShow=[
    'id'=>['width'=>'col-md-0'] ,
    'name'                => ['width'=>'col-md-12'],
    'remark'              => ['width'=>'col-md-12'],
    //'status'              => ['width'=>'col-md-6','enum'=>['draft','locked'],'enum_default'=>'draft'],
    'instructor_id'      => ['width'=>'col-md-6','related_table'=>'App\Models\Instructor\Instructor','related_value'=>'first_name'],
    'package_id'         => ['width'=>'col-md-6','related_table'=>'App\Models\Package\Package','related_value'=>'name'],
    'start_datetime'      => ['width'=>'col-md-6'],
    'end_datetime'        => ['width'=>'col-md-6'],
    'qty_book'        => ['width'=>'col-md-6'],
    'qty_max'              => ['width'=>'col-md-6'],
    //'status_document'=>['width'=>'col-md-4','enum'=>['draft','locked'],'enum_default'=>'draft'],
];

public $detailShow=[
    'id'=>['width'=>'col-md-0'] ,
    'start_datetime'      => ['width'=>'col-md-4',],
    'end_datetime'        => ['width'=>'col-md-4'],
    'name'                => ['width'=>'col-md-12'],
    'remark'              => ['width'=>'col-md-12'],
    //'status'              => [],
    'instructor_id'      => ['width'=>'col-md-6','related_table'=>'App\Models\Instructor\Instructor','related_value'=>'first_name'],
    'package_id'         => ['width'=>'col-md-6','related_table'=>'App\Models\Package\Package','related_value'=>'name'],
    'qty_book'              => ['width'=>'col-md-6'],
    'qty_max'              => ['width'=>'col-md-6'],
    
    //'status_document'     => ['width'=>'col-md-4','enum'=>['draft','locked'],'enum_default'=>'draft'],
    'created_at'     => ['width'=>'col-md-3'],  
    'created_by'=>['width'=>'col-md-3','related_table'=>'App\Models\User','related_value'=>'name'],
    'updated_at'     => ['width'=>'col-md-3'],
    'updated_by'=>['width'=>'col-md-3','related_table'=>'App\Models\User','related_value'=>'name']
];

    public function index()
    {
        $batchs = Batch::all(); // Get all members
        return BatchResource::collection($batchs); // Return resource collection
    }
    public function getData(Request $request)
    {
        // Fetch the data from the model
       // $members = Member::all(); // Adjust according to your needs
        $batchs = Batch::select([
            'id',
            'name',                
            'remark',              
            'status' ,             
            'instructor_id',      
            'package_id',         
            'start_datetime',      
            'end_datetime',        
            'status_document', 
            'qty_book',
            'qty_max',
            'created_at',
            'updated_at',
            'updated_by',
            'created_by'
        ])
        ->get();

        
        $s = datatables()->of($batchs)
            ->editColumn('start_datetime', function ($batch) {
                $valueCol = $batch->updated_at;
                //return $member->join_date;
                return view('PanelAdmin.component.datetime.view',compact('valueCol'));
            })
            ->editColumn('qty_max', function ($batch) {
               
                $valueCol = $batch->qty_book.'/'.$batch->qty_max;
             //   print_r($oIns->first_name);
               // exit();
                return $valueCol;
                //return view('PanelAdmin.component.datetime.view',compact('valueCol'));
            })
            ->editColumn('instructor_id', function ($batch) {
               
                $valueCol = $batch->instructor_id;
                $oIns = Instructor::find($valueCol);
             //   print_r($oIns->first_name);
               // exit();
                return $oIns->first_name.' '.$oIns->last_name;
                //return view('PanelAdmin.component.datetime.view',compact('valueCol'));
            })
            ->editColumn('package_id', function ($batch) {
                $valueCol = $batch->package_id;
                $oIns = Package::find($valueCol);

                return $oIns->name;
                //return view('PanelAdmin.component.datetime.view',compact('valueCol'));
            })
            ->editColumn('start_datetime', function ($batch) {
                $valueCol = date('d',strtotime($batch->start_datetime)).'-'.date('d M-Y',strtotime($batch->end_datetime)) ;
               
                return $valueCol;
                //return view('PanelAdmin.component.datetime.view',compact('valueCol'));
            })
            ->editColumn('updated_at', function ($batch) {
                $valueCol = $batch->updated_at;
                //return $member->join_date;
                return view('PanelAdmin.component.datetime.view',compact('valueCol'));
            })
           
            ->addColumn('action', function ($batch) {
                $route = 'batch';
                $module_data = $batch;
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
        $batch = Batch::find($id);
        if ($batch) {
            $batch->delete();
            return response()->json([
                'success' => true,
                'message' => 'batch deleted successfully!',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'batch not found!',
            ], 404);
        }
    }
    public function edit(request $request,response $response,$id){
        $param = $request->input();
        unset($param['_token']);
        $param['id'] = $id;
        $param['updated_by']=Auth::User()->id;
        $batch = Batch::find($id);
        
        if ($batch) {
            // Update the instructor's attributes
            $batch->update($param);
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
            'remark' => 'string',
            'instructor_id' => 'required', // Ensures exactly 4 digits are allowed
            'package_id'    => 'required',
            'start_datetime'   => 'required|date',
            'end_datetime'   => 'required|date'
            
        ]);
        
      
        $m = Batch::where('name',$validatedData['name'])->first();
       
        if(!isset($m->id)){
            $bacth = Batch::create([
                'name' => $validatedData['name'],
                'remark' => $validatedData['remark'],
                'instructor_id' => $validatedData['instructor_id'],
                'package_id' => $validatedData['package_id'],
                'start_datetime'=>$validatedData['start_datetime'],
                'end_datetime'=> $validatedData['end_datetime'],
                'created_by'=> Auth::user()->id,
                'updated_by'=> Auth::user()->id,
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Batch created successfully!',
                //'member' => $member,
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Batch Already Exits',
                //'member' => $member,
            ]);
        }
    }

    public function create(request $request,response $response,$id=''){
        //$BatchResourse = BatchResource::collection(Batch::find($id)->get())->toArray($request);
        $data = [];
        $config = [
            'page'   => [
                'title' => 'Batch & Session - Create',
                'description' => 'Batch Create - Description',
                'name' => 'Batch & Session ',
                'parent' => 'Batch',
                'author' => 'Telcomixo',
            ],
            'module' => 'batch',
            'route'  => 'batch',
            'meta'=> H1BHelper::combine_based_on_second($this->meta,$this->createShow),
            'data' => $data,
            'relation'=>[]
        ];
        //print_r('<pre>');
        //print_r($config);
        //exit();
        return view('PanelAdmin.Batch.create',compact('config'));
    }

    public function detail(request $request,response $response,$id=''){
        
        $BatchResourse = BatchResource::collection(Batch::where('id',$id)->get())->toArray($request);
        $data = $BatchResourse;
        $config = [
                    'page'   => [
                        'title' => 'Batch Detail - ID:'.$id,
                        'description' => 'Batch Detail - Description',
                        'name' => 'Detail Batch: ID-'.$id,
                        'parent' => 'Batch',
                        'author' => 'Telcomixo',
                    ],
                    'id'=>$id,
                    'module' => 'batch',
                    'route'  => 'batch',
                    'meta'=> H1BHelper::combine_based_on_second($this->meta,$this->detailShow),
                    'data' => $data,
                    'relation'=>[]
                    

                ];
        return view('PanelAdmin.Batch.detail',compact('config'));
    }

    public function list(request $request,response $response){

   
        $BatchResourse = BatchResource::collection(Batch::All())->toArray($request);
        $prevMonthCount = Batch::where('created_at','<', Carbon::now()->subMonthsNoOverflow()->endOfMonth()->toDateString())->count();
        $totalCount = Batch::All()->count();
        $percentageBatch = (($totalCount-$prevMonthCount)/$totalCount)*100;
        $data = $BatchResourse;
        $config = [
                    'page'   => [
                        'title' => 'Batch List',
                        'description' => 'Batch Listing - Description',
                        'name' => 'Listing Batch',
                        'parent' => 'Batch',
                        'author' => 'Telcomixo',
                    ],
                    'module' => 'batch',
                    'columns' => json_encode($this->columns,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                    'objModule'=> Batch::All(),
                    'route'  => 'bacth',
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
                        'Total Batch'   => [
                            'name'=> 'Total Batch Schedule',
                            'width' => 'col-md-12',
                            'icon'=> 'ri-user-3-line font-size-24',
                            'module'=> 'member',
                            'count-value'=> $totalCount,
                            'percentage-value'=>  H1BHelper::isHasDecimal($percentageBatch).'%',                           
                            'render'=> '',
                            'onClick'=> ''
                        ],
                    
                        
                    ]
                ];
  
   // print_r('<pre>');
   // print_r($this->meta);
   // print_r($this->listShow);
   // print_r($config['meta']);
   // exit();
    return view('PanelAdmin.Batch.list',compact('config'));
}
}