<?php

namespace App\Models\Member;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Member\MemberPackageOrder;

class Member extends Authenticatable
{
    use HasFactory;
    use HasFactory, Notifiable;
    protected $authPasswordName = 'pin';
    protected $table = 'member';

    
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
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
     
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
            'birthday' => 'date',
            'email_verified_at' => 'join_date',
            'pin' => 'hashed',
            'password' => 'hashed',
            
        ];
    }
    public function getMeta(){
        return $this->meta;
    }
    public function PackageOrder()
    {
        return $this->hasMany(MemberPackageOrder::class,'member_id');
    } 
}
