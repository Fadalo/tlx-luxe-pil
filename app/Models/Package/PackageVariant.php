<?php

namespace App\Models\Package;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Package\Package;
use App\Models\Member\MemberPackageOrder;
use App\Models\Package\PackageVariantRule;

class PackageVariant extends Model
{
    
    use HasFactory, Notifiable;

    protected $table = 'package_variant';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'package_id',
        'desc',
        'package_qty_ticket',
        'package_qty_used_book',
        
        'status_document',
        'created_by',
        'updated_by'

    ];

    public function Package()
    {
        return $this->belongsTo(Package::class,'package_id');
    }

    public function PackageOrder()
    {
        return $this->belongsTo(MemberPackageOrder::class,'id');
    }
    public function PackageVariantRule()
    {
        return $this->hasMany(PackageVariantRule::class,'package_variant_id');
    }
        
}
