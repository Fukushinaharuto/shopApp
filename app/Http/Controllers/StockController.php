<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\stock;
use App\Models\UserStock;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function index()
    {
        $stocks =Stock::paginate(6);

        return view('stocks', ['stocks' => $stocks]);
    }

    public function myCart()
    {
        $myCartStocks = UserStock::all();
        return view('myCart', ['myCartStocks' => $myCartStocks]);
    }

    public function addMyCart(Request $request)
    {
        $user_id = Auth::id();
        $stock_id = $request->input('stock_id');

        $cartAddInfo = UserStock::first0rCreate(['stock_id' => $stock_id, 'user_id' => $user_id]);

        if($cartAddInfo->wasRecentlyCreated){
            $message = 'カートに追加しました';
        }
        else{
            $message = 'カートに登録済みです';
        }
        $myCartStocks = UserStock::where('user_id',$user_id)->get();
        
        return view('myCart', ['myCartStocks' => $myCartStocks, 'message' => $message]);
    }
}
