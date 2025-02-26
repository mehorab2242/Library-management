<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'published_year',
        'author_id',
    ];
    //Define the inverse relationship
    public function author(){
        return $this->belongsTo(Author::class);
    }
}
