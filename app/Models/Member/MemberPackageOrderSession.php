<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Member\MemberPackageOrder;

class MemberPackageOrderSession extends Model
{
    use HasFactory;
    protected $table = 'member_package_order_session';

    public function MemberPackageOrder(){
        return $this->belongsTo(MemberPackageOrder::class);
    }
}
