<?php

namespace App\Models\Member;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Member\MemberPackageOrder;
use Carbon\Carbon;
class Member extends Authenticatable
{
    use HasFactory;
    use HasFactory, Notifiable;
    protected $authPasswordName = 'pin';
    protected $table = 'member';

    
   
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
        'join_date',
        'activated_date',
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
    public function getMeta(){
        return $this->meta;
    }
    public function PackageOrder()
    {
        return $this->hasMany(MemberPackageOrder::class,'member_id');
    } 
}
