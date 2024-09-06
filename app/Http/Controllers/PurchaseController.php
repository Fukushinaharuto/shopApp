<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserStock;
use App\Models\PurchaseHistory; 
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function showPurchaseHistory()
    {
        $user_id = Auth::id();
        $purchases = PurchaseHistory::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();

        return view('purchase_history', ['purchases' => $purchases]);
    }

    public function purchaseCart()
    {
        $user_id = Auth::id();
        $myCartStocks = UserStock::with('stock')->where('user_id', $user_id)->get();
    
        if ($myCartStocks->isEmpty()) {
            return redirect()->route('stock.myCart')->with('error', 'カートが空です。');
        }
    
        // 購入する商品の情報をまとめる
        $items = [];
        $totalPrice = 0;
        foreach ($myCartStocks as $cartItem) {
            $items[] = [
                'name' => $cartItem->stock->name,
                'price' => $cartItem->stock->price,
                'quantity' => $cartItem->quantity,
                'imagePath' => $cartItem->stock->imagePath, // この行を追加
            ];
            $totalPrice += $cartItem->stock->price * $cartItem->quantity;
        }
    
        // 購入履歴に保存
        PurchaseHistory::create([
            'user_id' => $user_id,
            'items' => json_encode($items),
            'total_price' => $totalPrice,
        ]);
    
        // カートを空にする
        UserStock::where('user_id', $user_id)->delete();
    
        return redirect()->route('stock.myCart')->with('message', '購入が完了しました。');
    }
}
