<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    
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
}
