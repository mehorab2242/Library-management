<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'bio'
    ];
    //Define the one-to-many relationship
    public function books(){
        return $this->hasMany(Book::class);
    }
}
