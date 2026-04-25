<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'description',
        'date'
    ];

    public function authors(){
        return $this->belongsToMany(Author::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
}
