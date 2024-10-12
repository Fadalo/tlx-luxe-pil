<?php

namespace App\Models\Instructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Instructor\Instructor;
use App\Models\Instructor\InstructorPackageInsentifRule;
use App\Models\Instructor\InstructorScheadule;




class InstructorContract extends Model
{
    use HasFactory;
    protected $table = 'instructor_contract';
    
    public function Instructor(){
        return $this->belongsTo(Instructor::class);
    }
    public function InstructorPackageInsentifRule()
    {
        return $this->belongsToMany(InstructorPackageInsentifRule::class);
    }   
    public function InstructorScheadule()
    {
        return $this->belongsToMany(InstructorScheadule::class);
    } 
}
