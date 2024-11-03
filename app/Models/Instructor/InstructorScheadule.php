<?php

namespace App\Models\Instructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Instructor\InstructorContract;
class InstructorScheadule extends Model
{
    use HasFactory;
    protected $table = 'instructor_scheadule';

    public function InstructorContract(){
        return $this->belongsTo(InstructorContract::class,'instructor_contract_id');
    }
}

