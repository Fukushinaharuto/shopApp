<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStock extends Model
{
    use HasFactory;
    protected $table ='users_stocks';

    protected $fillable = [
        'stock_id', 'user_id',
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }
}
