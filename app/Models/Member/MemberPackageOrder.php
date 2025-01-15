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

    protected $fillable = [
        'member_id',
        'package_variant_id',
        'batch_id',
        'activated_package_started_datetime',
        'activated_package_due_date',
        'activated_ticket_started_datetime',
        'activated_ticket_due_date',
        'qty_ticket_used',
        'qty_ticket_available',
        'status_package',
        'status_payment',
        'is_member_created',
        'status_document',
        'created_by',
        'updated_at',
        'updated_by',
        
        
        
    ];
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
    
    public function scopeBook($query)
    {
        return $query->where('status_package', 'book');
    }

    public function scopeAvailable($query)
    {
        return $query->where('status_package', 'available');
    }

    public function scopeActived($query)
    {
        return $query->where('status_package', 'actived');
    }
    
    public function scopeExpired($query)
    {
        return $query->where('status_package', 'expired');
    }
    public static function MemberQtyAvailable($query)
    {
        
        return $query;
    
    }
}
