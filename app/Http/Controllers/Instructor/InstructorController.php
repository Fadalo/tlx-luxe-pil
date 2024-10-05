<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;
use Illuminate\Http\Response; 
use App\Http\Controllers\Controller; 
       

use App\Http\Resources\Instructor\InstructorResource;
use App\Http\Resources\UserResource;
use App\Models\Instructor\Instructor;
use App\Models\User;
use App\Helpers\H1BHelper;

class InstructorController extends Controller
{
    public  $meta = [ 
        'id'              => ['type'=> 'text'],
        'first_name'      => ['type'=> 'text'],
        'last_name'       => ['type'=> 'text'],
        'phone_no'        => ['type'=> 'phone'],
        'birthday'        => ['type'=> 'date'],
        'pin'             => ['type'=> 'password'],
        'join_date'       => ['type'=> 'datetime'],
        'actived_date'     => ['type'=> 'datetime'],
        'referal_by'     => ['type'=> 'text'],
        'approved_date'   => ['type'=> 'datetime'],
        'status_document' => ['type'=> 'dropdown'],
        'created_at' => ['type'=> 'datetime'],
        'created_by' => ['type'=> 'select2'],
        'updated_at' => ['type'=> 'datetime'],
        'updated_by' => ['type'=> 'select2']
    ];

    public $listShow = [
        //'id'=>[] ,
        'name'=>['type'=>'custom','call_m'=> 'name_callback' ,'callback_execute'=>'name_callback($item)','callback_function'=>'function name_callback($item)
        {
            return $item["first_name"].\' \'.$item["last_name"];
        }'], 
        
        //'first_name'=>[], 
        //'last_name'=>[], 
        'phone_no'=>[], 
        'birthday'=>[], 
        'join_date'=>[],
        'actived_date'=>[],
        //'status_document'=>['enum'=>['draft','lock'],'enum_default'=>'draft'],
        'updated_at'=>[],
        //'updated_by'=>['related_table'=>'user','related_value'=>'name']
    ] ;

    public $createShow=[
        'id'=>[] ,
        'first_name'=>[], 
        'last_name'=>[] , 
        'phone_no'=>[], 
        'birthday'=>[],
        'pin'=>[], 
        'join_date'=>[],
        'actived_date'=>[],
        'status_document'=>['enum'=>['draft','lock'],'enum_default'=>'draft'],
    ];

    public $detailShow=[
        'id' ,
        'first_name', 
        'last_name' , 
        'phone_no', 
        'birthday', 
        'join_date',
        'actived_date',
        'status_document',
        'updated_at',
        'updated_by'=>['related_table'=>'user','related_value'=>'name']
    ];
   
    public function index()
    {
        $instructors = Instructor::all(); // Get all members
        return InstuctorResource::collection($instructors); // Return resource collection
    }
    
    public function create(request $request,response $response){
        return view('PanelAdmin.Instructor.create');
    }

    public function detail(request $request,response $response){
        return view('PanelAdmin.Instructor.create');
    }
    
    public function list(request $request,response $response){

        $InstructorResourse = InstructorResource::collection(Instructor::All())->toArray($request);
        $data = $InstructorResourse;
        $config = [
                    'page'   => [
                        'title' => 'Instructor List',
                        'description' => 'Instructor Listing - Description',
                        'name' => 'Listing Instructor',
                        'parent' => 'Instructor',
                        'author' => 'Telcomixo',
                    ],
                    'module' => 'instructor',
                    'route'  => 'instructor',
                    'meta'=> H1BHelper::combine_based_on_second($this->meta,$this->listShow),
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
                            'name'=> 'Total Instructor',
                            'icon'=> 'ri-user-3-line font-size-24',
                            'module'=> 'instructor',
                            'count-value'=> '100',
                            'percentage-value'=> '20%',                            
                            'render'=> '',
                            'onClick'=> ''
                        ],
                       
                        'Today Session' => [
                            'name'=> 'Today Session',
                            'icon'=> 'ri-user-3-line font-size-24',
                            'module'=> 'instructor',
                            'count-value'=> '30',
                            'percentage-value'=> '15%',
                            'render'=> '',
                            'onClick'=> ''
                        ],
                        'Active Member'   => [
                            'name'=> 'Total instructor',
                            'icon'=> 'ri-user-3-line font-size-24',
                            'module'=> 'instructor',
                            'count-value'=> '100',
                            'percentage-value'=> '20%',                            
                            'render'=> '',
                            'onClick'=> ''
                        ],
                        'Not Active Member'   => [
                            'name'=> 'Total instructor',
                            'icon'=> 'ri-user-3-line font-size-24',
                            'module'=> 'member',
                            'count-value'=> '100',
                            'percentage-value'=> '20%',                            
                            'render'=> '',
                            'onClick'=> ''
                        ],
                        
                    ]
                ];
      
        return view('PanelAdmin.Instructor.list',compact('config'));
    }
}