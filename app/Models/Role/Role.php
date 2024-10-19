<?php

namespace App\Models\Role;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Role extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'role';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_name',
        'remark',
        'created_by',
        'updated_by',
    ];

   
        
    
  
}
