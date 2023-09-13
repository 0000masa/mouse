<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;//追加
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;



class User extends Authenticatable implements MustVerifyEmail //implements MustVerifyEmailを
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function articles()   
    {
        return $this->hasMany(Article::class);  
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
      public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
    public function getByUser(int $limit_count = 10)
    {
         return $this->articles()->with('user')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function followers()
    {
       return $this->belongsToMany(self::class, "follows", "follower_user_id", "followee_user_id");
    }
    
    public function follows()
    {
       return $this->belongsToMany(self::class, "follows", "followee_user_id", "follower_user_id");
    }
    
    public function profile()   
    {
        return $this->hasOne(Profile::class);  
    }
}
