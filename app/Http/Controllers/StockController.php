<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\stock;
use App\Models\UserStock;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite; 
use App\Models\Tag;

class StockController extends Controller
{


    public function index(Request $request)
    {
        $query = $request->input('query');
        $tagIds = $request->input('tag_id', []);
        $stocks = Stock::with('tags');
        if ($query){
            $stocks->where('name','like',"%{$query}%");
        }

        if (!empty($tagIds)){
            $stocks->whereHas('tags', function ($query) use ($tagIds){
                $query->whereIn('tags.id', $tagIds);
            });
        }

        $stocks = $stocks->paginate(9);

        $tags = Tag::all();

        $user_id = Auth::id(); 
        $favorites = Favorite::where('user_id', $user_id)->pluck('stock_id')->toArray();

        $user = Auth::user();


        return view('stocks', ['stocks' => $stocks, 'favorites' => $favorites, 'tags' =>$tags, 'user' => $user]);
    }

    public function detail($id)
    {
        $stock = Stock::findOrFail($id);
        return view('detail_stocks', ['stock' => $stock]);
    }

    public function search(Request $request)
    {
        $tags = Tag::all();
        $query = $request->input('query');
        if ($query){
            $stocks = Stock::where('name', 'like', "%{$query}%")->paginate(9);
        }else{
            $stocks = Stock::paginate(9);
        }

        return view('stocks', ['stocks' => $stocks,'tags' =>$tags]);
        
    }

    public function create()
    {
        $tags = Tag::all();
        $user = Auth::user();
        $isAdmin = $user->role_flag;

        if($isAdmin === 1){
            return redirect()->route('stock.index');

        }elseif($isAdmin === 0){
            return view('stockAdd', ['tags' =>$tags]);
        }else{
            return redirect()->route('stock.index');
        }
        
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

        $tagIds = $request->input('tags', []);
        $stock->tags()->sync($tagIds);
        
        return redirect()->back()->with('message', '新しい商品を追加しました');
    }

    public function stockDelete(Request $request)
    {
        $stockIds = $request->input('stock_ids'); // フォームから送信されたチェックボックスのIDリストを取得
        if (!empty($stockIds)) {
            Stock::whereIn('id', $stockIds)->delete(); // 選択された商品のIDに該当するレコードを削除
            return redirect()->route('stock.index')->with('success', '削除しました'); // 成功メッセージと共にリダイレクト
        } else {
            return redirect()->route('stock.index')->with('error', '削除する商品を選択してください'); // エラーメッセージと共にリダイレクト
        }
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