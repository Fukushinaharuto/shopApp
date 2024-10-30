<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_id',
        'user_id',
        'rating',
        'comment',
    ];

    // Stock（商品）モデルとのリレーション
    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    // User（ユーザー）モデルとのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
