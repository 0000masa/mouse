<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    //use SoftDeletes;
    use HasFactory;
    
    protected $fillable = [
    'user_id',
    'product',
    'price',
    'weight',
    'maximum_dpi',
    'buttons',
    'manufacture_id',
    'connection_id',
    'battery_id',
    'evaluation_id',
    'explanation',
    'image_url',
    ];
    
    public function getPaginateByLimit(int $limit_count = 10)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function manufacture()
    {
        return $this->belongsTo(Manufacture::class);
    }
    
    public function connection()
    {
        return $this->belongsTo(Connection::class);
    }
    
    public function battery()
    {
        return $this->belongsTo(Battery::class);
    }
    
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
     public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
    
    
    public function isLikedBy($user): bool {
        return Like::where('user_id', $user->id)->where('article_id', $this->id)->first() !==null;
    }
}
