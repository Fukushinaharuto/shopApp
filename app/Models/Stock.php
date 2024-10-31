<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $guarded = [
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

    public function purchaseHistories()
    {
        return $this->belongsToMany(PurchaseHistory::class, 'purchase_history_stock', 'stock_id', 'purchase_history_id');
    }
}
