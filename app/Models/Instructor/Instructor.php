<?php

namespace App\Models\Instructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Instructor\InstructorContract;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class Instructor extends Model
{
    use HasFactory;
    protected $authPasswordName = 'pin';
    protected $table = 'instructor';

    
    
    protected static function booted()
    {
        static::creating(function ($member) {
            if (is_null($member->join_date)) {
                $member->join_date = Carbon::now();
            }

            if (is_null($member->activated_date)) {
                $member->actived_date = Carbon::now();
            }
        });
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_no',
        'birthday',
        'pin',
        'updated_by',
        'created_by',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
     
        //'created_at',
       // 'created_by',
        
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    
     protected function casts(): array
    {
        return [
            'birthday' => 'date',
            'email_verified_at' => 'join_date',
            'pin' => 'hashed',
            'password' => 'hashed',
            
        ];
    }

    public function InstructorContract()
    {
        return $this->belongsToMany(InstructorContract::class,'instructor_id');
    }   
}
