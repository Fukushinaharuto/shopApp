<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use App\Models\stock;
use App\Models\UserStock;

class FavoritesController extends Controller
{

    public function index()
    {
        $user_id = Auth::id();
        // ユーザーのお気に入り商品を取得
        $favorites = Favorite::where('user_id', $user_id)->pluck('stock_id')->toArray();
        // お気に入りの商品を取得
        $stocks = Stock::whereIn('id', $favorites)->paginate(9);

        return view('stocks_favorite', ['stocks' => $stocks]);
    }
    
    public function addfavorite(Request $request, $stock_id)
    {
        $user_id = Auth::id();

    $favorite = Favorite::where('user_id', $user_id)->where('stock_id', $stock_id)->first();
    if (!$favorite) {
        Favorite::create([
            'user_id' => $user_id,
            'stock_id' => $stock_id,
        ]);
        return redirect()->back()->with('message', '商品をお気に入りに追加しました');
    }
    return redirect()->back()->with('message', 'この商品すでにお気に入り登録されています');
    }
    
    public function removeFavorite(Request $request, $stock_id)
    {
        $user_id = Auth::id();
        $favorite = Favorite::where('user_id', $user_id)->where('stock_id', $stock_id)->firstOrFail();
        $favorite->delete();
        
        return redirect()->back()->with('message', "商品をお気に入りから削除しました");
    }
    
    
}
