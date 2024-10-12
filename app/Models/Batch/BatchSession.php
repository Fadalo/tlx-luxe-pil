<?php

namespace App\Models\Batch;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Batch\Batch;

class BatchSession extends Model
{
    use HasFactory;
    protected $table = 'batch_session';

    public function Batch()
    {
        return $this->belongsTo(Batch::class);
    }
    
}
