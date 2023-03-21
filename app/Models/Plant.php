<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'image'];
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
