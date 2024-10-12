<?php

namespace App\Models\Instructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Instructor\InstructorContract;

class Instructor extends Model
{
    use HasFactory;
    protected $table = 'instructor';

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phoneno',
        'email',
        'pin',
        
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'pin',
        'created_at',
        'created_by',
        
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
           
            'pin' => 'hashed',
        ];
    }

    public function InstructorContract()
    {
        return $this->belongsToMany(InstructorContract::class);
    }   
}
