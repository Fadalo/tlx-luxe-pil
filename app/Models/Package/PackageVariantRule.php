<?php

namespace App\Models\Package;

use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Package\PackageVariant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PackageVariantRule extends Pivot
{

    use HasFactory, Notifiable;

    protected $table = 'package_variant_rule';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'package_id',
        'desc',
        'package_available2activated_duration',
        'package_ticket_duration',
        'package_qty_ticket',
        'status_document',
        'created_by',
        'updated_by'

    ];

    public function PackageVariant()
    {
        return $this->belongsTo(PackageVariant::class,'package_variant_id');
    }
}
