<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    
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
