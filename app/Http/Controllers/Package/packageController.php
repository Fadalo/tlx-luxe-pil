<?php

namespace App\Http\Controllers\Package;

use Illuminate\Http\Request;
use Illuminate\Http\Response; 
use App\Http\Controllers\Controller; 
use App\Http\Resources\Package\PackageResource;
use App\Models\Package\Package;
use App\Models\User;
use App\Helpers\H1BHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class packageController extends Controller
{            
    public $columns = [
        ['data' => 'action', 'width' => '5%'],
        ['data' => 'name', 'width' => '25%'],
        ['data' => 'desc', 'width' => '50%'],
        
        ['data' => 'updated_at', 'width' => '10%']
    ];
    public  $meta = [ 
        'id'        => ['type'=> 'hidden','label'=>'ID' ],
        'name'      => ['type'=> 'text','label'=>'Name' ],
        'desc'      => ['type'=> 'textarea','label'=>'Desc' ],
        'status_document' => ['type'=> 'dropdown','label'=>'Status Document' ],
        'created_at' => ['type'=> 'datetime','label'=>'CreatedAt' ],
        'created_by' => ['type'=> 'select2','label'=>'CreatedBy' ],
        'updated_at' => ['type'=> 'datetime','label'=>'UpdatedAt' ],
        'updated_by' => ['type'=> 'select2','label'=>'UpdatedBy' ]
    ];

    public $listShow = [
        'name'=>[], 
        'desc'=>[], 
        //'status_document'=>['enum'=>['draft','lock'],'enum_default'=>'draft'],
        'updated_at'=>[],
        //'updated_by'=>['related_table'=>'user','related_value'=>'name']
    ] ;

    public $createShow=[
        'id' =>['width'=> 'col-md-0'],
        'name'=>['width'=>'col-md-06'], 
        //'status_document'=>['width'=>'col-md-06','enum'=>['draft','locked'],'enum_default'=>'draft'],
        'desc'=>['width'=>'col-md-12'] , 
        
    ];

    public $detailShow=[
        'id' =>['width'=> 'col-md-0'],
        
        'name'=>['width'=> 'col-md-6'], 
      
        'status_document'=>['width'=> 'col-md-6','enum'=>['draft','locked'],'enum_default'=>'draft'],
        'desc'=>['width'=> 'col-md-12'] , 
        'created_at'=>['width'=> 'col-md-3'],
        'created_by'=>['width'=> 'col-md-3','related_table'=>'App\Models\User','related_value'=>'name'],
        'updated_at'=>['width'=> 'col-md-3'],
        'updated_by'=>['width'=> 'col-md-3','related_table'=>'App\Models\User','related_value'=>'name']
    ];
   
    public function index()
    {
        $packages = Package::all(); // Get all members
        return PackageResource::collection($packages); // Return resource collection
    }
    public function getData(Request $request)
    {
        // Fetch the data from the model
       // $members = Member::all(); // Adjust according to your needs
        $packages = Package::select([
            'id',
            'name', // Combine first and last name
            'desc',
            'created_at',
            'updated_at',
            'updated_by',
            'created_by'

        ])
        ->get();

        

        $s = datatables()->of($packages)
            ->editColumn('updated_at', function ($package) {
                $valueCol = $package->updated_at;
                //return $member->join_date;
                return view('PanelAdmin.component.datetime.view',compact('valueCol'));
            })
           
            ->addColumn('action', function ($package) {
                $route = 'package';
                $module_data = $package;
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
        $package = Package::find($id);
        if ($package) {
            $package->delete();
            return response()->json([
                'success' => true,
                'message' => 'Package deleted successfully!',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Package not found!',
            ], 404);
        }
    }
    public function store(request $request,response $response)
    {
        //print_r(Auth::user()->id);
        //exit();
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'max:255',
           
        ]);
        
        $package = Package::create([
            'name' => $validatedData['name'],
            'desc' => $validatedData['desc'],
            'updated_by'=> Auth::user()->id,
            'created_by'=> Auth::user()->id
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Package created successfully!',
            'package' => $package,
        ]);
    }
    public function create(request $request,response $response){
       // $PackageResource = PackageResource::collection(Package::find($id)->get())->toArray($request);
        $data = [];
        $config = [
                    'page'   => [
                        'title' => 'Package Create' ,
                        'description' => 'Package Create - Description',
                        'name' => 'Package Create',
                        'parent' => 'Package',
                        'author' => 'Telcomixo',
                    ],
                    'module' => 'package',
                    'route'  => 'package',
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
        return view('PanelAdmin.Package.create',compact('config'));
    }

    public function detail(request $request,response $response,$id){
        $PackageResource = PackageResource::collection(Package::find($id)->get())->toArray($request);
        $data = $PackageResource;
        $config = [
                    'page'   => [
                        'title' => 'Package Detail - ID:'.$id ,
                        'description' => 'Package Detail - Description',
                        'name' => 'Package Detail - [ '.$data[0]['name'].'/'.$id.' ]',
                        'parent' => 'Package',
                        'author' => 'Telcomixo',
                    ],
                    'module' => 'package',
                    'route'  => 'package',
                    'meta'=> H1BHelper::combine_based_on_second($this->meta,$this->detailShow),
                    'data' => $data,
                    'relation'=>[
                        '0'   => [
                            'id'=> 'my-package',
                            'icon'=> '<i class="far fa-envelope"></i>',
                            'name'=> 'Variant',
                            'type'=> 'crud',
                            'module'=> 'package_variant',
                            'render'=> 'PanelAdmin.Package.component.Tab.packageVariant',
                        ],
                       
                        
                        
                    ]

                ];
        return view('PanelAdmin.Member.detail',compact('config'));
    }
    
    public function list(request $request,response $response){

        $PackageResource = PackageResource::collection(Package::All())->toArray($request);
        $data = $PackageResource;
        $config = [
                    'page'   => [
                        'title' => 'Package List',
                        'description' => 'Package Listing - Description',
                        'name' => 'Listing Package',
                        'parent' => 'Package',
                        'author' => 'Telcomixo',
                    ],
                    'module' => 'package',
                    'columns' => json_encode($this->columns,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                    'objModule'=> Package::All(),
                    'route'  => 'package',
                    'sort' =>"[[3, 'desc']]",
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
      
        return view('PanelAdmin.Package.list',compact('config'));
    }
}
