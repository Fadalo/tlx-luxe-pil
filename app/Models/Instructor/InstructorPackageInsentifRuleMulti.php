<?php

namespace App\Models\Instructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Instructor\InstructorPackageInsentifRule;

class InstructorPackageInsentifRuleMulti extends Model
{
    use HasFactory;
    protected $table = 'inst_pkg_ins_rule_multi';

    public function InstructorPackageInsentifRule(){
        return $this->belongsTo(InstructorPackageInsentifRule::class);
    }
}
