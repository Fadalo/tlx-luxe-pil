<?php

namespace App\Models\Package;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Package\PackageVariantRule;
class Rule extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'rule';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'desc',
        'function',
        'formula',
        'status_document',
        'created_by',
        'updated_by',
    ];

    public function PackageVariantRule()
    {
        return $this->hasMany(PackageVariantRule::class,'rule_id');
    }

}
