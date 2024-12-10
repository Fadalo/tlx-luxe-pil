<?php

namespace App\Models\Member;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Member\MemberPackageOrder;
use Carbon\Carbon;
class MemberPackageOrderPayment extends Authenticatable
{
    use HasFactory;
    use HasFactory, Notifiable;
    protected $table = 'member_package_order_payment';
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'member_package_order_id',
        'payment_type',
        'bank',
        'bank_account',
        'amount',
        'payment_proof',
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

    
    public function getMeta(){
        return $this->meta;
    }
    public function PackageOrder()
    {
        return $this->hasMany(MemberPackageOrder::class,'member_package_order_id');
    } 
}
