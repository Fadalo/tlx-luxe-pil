<?php

namespace App\Models\Instructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Instructor\Instructor;
use App\Models\Instructor\InstructorPackageInsentifRule;
use App\Models\Instructor\InstructorScheadule;
use App\Models\Package\Package;





class InstructorContract extends Model
{
    use HasFactory;
    protected $table = 'instructor_contract';
    protected $fillable = [
        
        'instructor_id',
        'package_id',
        'contract_activated_date',
        'contract_start_date',
        'contract_end_date',
        'remark',
        'status_document',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];

    public function Instructor(){
        return $this->belongsTo(Instructor::class,'instructor_id');
    }
    public function Package(){
        return $this->belongsTo(Package::class,'package_id');
    }
    public function InstructorPackageInsentifRule()
    {
        return $this->belongsToMany(InstructorPackageInsentifRule::class,'instructor_contract_id');
    }   
    public function InstructorScheadule()
    {
        return $this->belongsToMany(InstructorScheadule::class,'instructor_contract_id');
    } 
}
