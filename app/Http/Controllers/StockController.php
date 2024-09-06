<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\stock;
use App\Models\UserStock;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite; 

class StockController extends Controller
{
    public function index(Request $request)
    {
        $stocks =Stock::paginate(6);
        $user_id = Auth::id(); 
        $favorites = Favorite::where('user_id', $user_id)->pluck('stock_id')->toArray();

        return view('stocks', ['stocks' => $stocks, 'favorites' => $favorites]);
    }

    public function detail($id)
    {
        $stock = Stock::findOrFail($id);
        return view('detail_stocks', ['stock' => $stock]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        if ($query){
            $stocks = Stock::where('name', 'like', "%{$query}%")->paginate(6);
        }else{
            $stocks = Stock::paginate(6);
        }

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
        $user_id = Auth::id();
        $myCartStocks = UserStock::with('stock')->where('user_id', $user_id)->get();
        return view('myCart', ['myCartStocks' => $myCartStocks]);
    }
    

    public function addMyCart(Request $request)
    {
        $user_id = Auth::id();
        $stock_id = $request->input('stock_id');
        $quantity = $request->input('quantity', 1); // 指定された数量を取得
        
        // カートに商品が既に存在するか確認
        $cartItem = UserStock::where('stock_id', $stock_id)->where('user_id', $user_id)->first();
        
        if ($cartItem) {
            // 商品がカートに既に存在する場合、数量を更新
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // 商品がカートに存在しない場合、新たに追加

                $newCartItem = new UserStock();
                $newCartItem->stock_id = $stock_id;
                $newCartItem->user_id = $user_id;
                $newCartItem->quantity = $quantity; // 指定された数量をそのまま保存
                $newCartItem->save();

        }
    
        $message = 'カートに追加しました';
        return redirect()->back()->with('message', $message);
    }
    

    public function updateCart(Request $request, $id)
    {
        $user_id = Auth::id();
        $quantity = $request->input('quantity');
        $cartItem = UserStock::where('id', $id)->where('user_id', $user_id)->firstOrfail();
        $cartItem->quantity = $quantity;
        $cartItem->save();

        return redirect()->route('stock.myCart')->with('message', 'カートの内容が更新されました');
    }

    public function deleteCart($id)
    {
        $user_id = Auth::id();
        $cartItem = UserStock::where('id', $id)->where('user_id', $user_id)->firstOrFail();
        $cartItem->delete();

        return redirect()->route('stock.myCart')->with('message', '商品をカートから削除しました');
    }
    
    
};