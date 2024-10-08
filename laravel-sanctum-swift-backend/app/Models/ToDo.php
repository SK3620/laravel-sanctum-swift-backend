<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
    use HasFactory;

    protected $table = "todos";

    protected $fillable = ['title', 'user_id'];

     // Todoが属するUserを取得するリレーション
     public function user()
     {
         return $this->belongsTo(User::class);
     }
}
