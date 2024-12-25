<?php

namespace App\Models\Autoresponse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Autoresponse extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'autoresponse';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'module',
        'name',
        'templete',
        'created_by',
        'updated_by',
    ];

   
        
    
  
}
