<?php

namespace App\Models\Batch;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Batch\BatchSession;

class Batch extends Model
{
    use HasFactory;
    protected $table = 'batch';

    protected $fillable = [
        'name',
        'remark',
        'package_id',
        'instructor_id',
        'start_datetime',
        'end_datetime',
        'updated_by',
        'created_by',
        'qty_book',
        'qty_max'
    ];
    
    public function BatchSession()
    {
        return $this->hasMany(BatchSession::class);
    }
    
}
