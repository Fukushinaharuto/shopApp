<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $guarde= [
        'id'
    ];

    protected $table = 'stocks';

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'stocks_tag', 'stock_id', 'tag_id');
    }

    public function descriptions()
    {
        return $this->hasMany(ProductDescription::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    // public function 
}
