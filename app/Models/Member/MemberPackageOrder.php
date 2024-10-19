<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Member\Member;
use App\Models\Package\PackageVariant;
use App\Models\Member\MemberPackageOrderSession;


class MemberPackageOrder extends Model
{
    use HasFactory;
    protected $table = 'member_package_order';

    public function Member(){
        return $this->belongsTo(Member::class, 'member_id');
    }
    public function PackageVariant(){
        return $this->hasMany(PackageVariant::class,'id');
    }
    public function MemberPackageOrderSession()
    {
        return $this->hasMany(MemberPackageOrderSession::class);
    }   
    
    
}
