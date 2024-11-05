<?php

namespace App\Models\Role;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RoleRule extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'role_rule';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'menu_id',
        'role_rule_name',
        'remark',
        'created_by',
        'updated_by',
    ];

   
        
    
  
}
