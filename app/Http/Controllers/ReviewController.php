<?php

namespace App\Http\Controllers;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\PurchaseHistory;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
class ReviewController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|max:500',
        'stock_id' => 'required|exists:stocks,id'
    ]);
    $user = auth()->user();
    $stockId = $request->input('stock_id');
    $userId = Auth::id();

    // ユーザーの購入履歴から関連する商品 ID を取得
    $hasPurchased = PurchaseHistory::where('user_id', $userId)
    ->whereHas('stocks', function ($query) use ($stockId) {
        // 'stocks.id'を明示的に指定
        $query->where('stocks.id', $stockId);
    })
    ->exists();

     // ユーザーが購入した商品IDの中に、レビューする商品IDが含まれているか確認
    if ($hasPurchased) {
        // レビューの保存処理
        $review = new Review();
        $review->user_id = $user->id;
        $review->stock_id = $stockId;
        $review->rating = $request->input('rating');
        $review->comment = $request->input('comment');



        if ($review->save()) {
            return redirect()->back()->with('success', 'レビューを投稿しました。');
        } else {
            return redirect()->back()->with('error', 'レビューの投稿に失敗しました。');
        }
    } else {
        return redirect()->back()->with('error', 'この商品を購入したユーザーのみレビューできます。');
    }

}

}