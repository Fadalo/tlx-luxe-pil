<?php

namespace App\Models\Instructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Instructor\InstructorPackageInsentifRuleMulti;
use App\Models\Instructor\InstructorContract;

class InstructorPackageInsentifRule extends Model
{
    use HasFactory;
    protected $table = 'instructor_package_insentif_rule';

    public function InstructorContract(){
        return $this->belongsTo(InstructorContract::class);
    }
    public function InstructorPackageInsentifRuleMulti()
    {
        return $this->belongsToMany(InstructorPackageInsentifRuleMulti::class);
    }   
}