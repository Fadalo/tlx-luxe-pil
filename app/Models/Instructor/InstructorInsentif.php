<?php

namespace App\Models\Instructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Instructor\InstructorContract;
use App\Models\Instructor\Instructor;
use App\Models\Batch\Batch\BatchSession;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class InstructorInsentif extends Model
{
    use HasFactory;
    protected $table = 'instructor_insentif';

    
    
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'instructor_id',
        'session_id',
        'name',
        'amount',
        'remark',
        'updated_by',
        'created_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
     
        //'created_at',
       // 'created_by',
        
    ];

    
    public function Instructor(){
        return $this->belongsTo(Instructor::class,'instructor_id');
    }  

}
