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
        $user = Auth::user();
    
        if (!$user) {
            return redirect()->route('register'); // 新規登録画面へリダイレクト
        }
    
        // ユーザーの住所が未入力の場合
        if (empty($user->name) || empty($user->email) || empty($user->postal_code) || empty($user->phone) || empty($user->prefecture) || empty($user->city) || empty($user->address_line)) {
            return redirect()->route('profile.edit'); // アカウント編集画面へリダイレクト
        }
    
        // カート内の商品を取得
        $myCartStocks = UserStock::with('stock')->where('user_id', $user_id)->get();
    
        if ($myCartStocks->isEmpty()) {
            return redirect()->route('stock.myCart')->with('error', 'カートが空です。');
        }
    
        // 購入する商品の情報をまとめる
        $items = [];
        $totalPrice = 0;
        $stockIdArray = []; // リレーション用の配列
    
        foreach ($myCartStocks as $cartItem) {
            $items[] = [
                'id' => $cartItem->stock->id,
                'name' => $cartItem->stock->name,
                'price' => $cartItem->stock->price,
                'quantity' => $cartItem->quantity,
                'imagePath' => $cartItem->stock->imagePath,
            ];
            $totalPrice += $cartItem->stock->price * $cartItem->quantity;
            $stockIdArray[] = $cartItem->stock->id; // 商品IDをリレーション用に追加
        }
    
        // 購入履歴を作成
        $purchaseHistory = PurchaseHistory::create([
            'user_id' => $user_id,
            'items' => json_encode($items),
            'total_price' => $totalPrice,
        ]);
    
        // リレーション経由で商品を追加
        $purchaseHistory->stocks()->attach($stockIdArray);
    
        // カートを空にする
        UserStock::where('user_id', $user_id)->delete();
    
        return redirect()->route('stock.myCart')->with('message', '購入が完了しました。');
    }
    
}
