<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class MenuAdmin extends Model
{
    use HasFactory;
    use HasFactory, Notifiable;

    protected $table = 'menu_admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'menu_type',
        'menu_name',
        'menu_controller',
        'menu_route',
        'menu_icon',
        'parent_id',
        'remark',
        'updated_by',
        'created_by',
    ];
        
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    
}
