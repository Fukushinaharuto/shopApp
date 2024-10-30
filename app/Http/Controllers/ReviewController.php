<?php

namespace App\Http\Controllers;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|max:500',
        'stock_id' => 'required|exists:stocks,id'
    ]);

    Review::create([
        'stock_id' => $request->stock_id,
        'user_id' => auth()->id(),
        'rating' => $request->rating,
        'comment' => $request->comment
    ]);

    return redirect()->back()->with('message', 'レビューが投稿されました。');
}

}
