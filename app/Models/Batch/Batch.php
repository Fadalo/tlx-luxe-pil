<?php

namespace App\Models\Batch;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Batch\BatchSession;

class Batch extends Model
{
    use HasFactory;
    protected $table = 'batch';

    
    public function BatchSession()
    {
        return $this->hasMany(BatchSession::class);
    }
    
}
