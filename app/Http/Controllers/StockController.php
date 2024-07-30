<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\stock;
use App\Models\UserStock;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $stocks =Stock::paginate(6);

        return view('stocks', ['stocks' => $stocks]);
    }

    public function create()
    {
        return view('stockAdd');
    }

    public function stockAdd(Request $request)
    {
        $stock = new Stock();
        $stock->name = $request->name;
        $stock->explain = $request->explain;
        $stock->price = $request->price;
        if ($request->hasFile('imagePath')) {
            $filePath = $request->file('imagePath')->store('public/images');
            $fileName = str_replace('public/images/', '', $filePath);
            $stock->imagePath = $fileName;
        }
        $stock->save();
        return redirect()->back()->with('message', '新しい商品を追加しました');
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
