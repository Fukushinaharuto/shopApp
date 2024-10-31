<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseHistory extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'items', 'total_price'];
    
    public function stocks()
    {
        return $this->belongsToMany(Stock::class, 'purchase_history_stock', 'purchase_history_id', 'stock_id');
    }
}
