<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'post_id',
        'likes',
        'desliks',
        'desc',
    ];
    public function comments(){
        return $this->hasMany(Comments::class,'post_id');
     }
}
