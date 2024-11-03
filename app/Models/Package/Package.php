<?php

namespace App\Models\Package;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Package\PackageVariant;
use App\Models\Instructor\InstructorContract;

class Package extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'package';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'desc',
        'status_document',
        'created_by',
        'updated_by',
    ];

   
    public function PackageVariant()
    {
        return $this->hasMany(PackageVariant::class,'package_id');
    }
        
    public function InstructorContract()
    {
        return $this->hasMany(InstructorContract::class,'package_id');
    }
    
  
}
