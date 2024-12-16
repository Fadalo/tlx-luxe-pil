<?php

namespace App\Models\Watem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Watem extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'watem';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'module',
        'name',
        'templete',
        'created_by',
        'updated_by',
    ];

   
        
    
  
}
