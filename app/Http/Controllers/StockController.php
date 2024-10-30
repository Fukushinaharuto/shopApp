<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\stock;
use App\Models\UserStock;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite; 
use App\Models\Tag;
use App\Models\ProductDescription;
use App\Models\Review;
use Illuminate\Support\Facades\DB;


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

        $stocks = $stocks->get();

        $tags = Tag::all();

        $user_id = Auth::id(); 
        $favorites = Favorite::where('user_id', $user_id)->pluck('stock_id')->toArray();

        $user = Auth::user();


        return view('stocks', ['stocks' => $stocks, 'favorites' => $favorites, 'tags' =>$tags, 'user' => $user]);
    }

    public function detail($id)
    {
        $stock = Stock::findOrFail($id);
        $overallRating = $stock->reviews->isNotEmpty() 
        ? $stock->reviews->avg('rating') 
        : null;

        return view('detail_stocks', ['stock' => $stock, 'overallRating' => $overallRating]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $tagIds = $request->input('tag_id', []);
    
        $stocks = Stock::with('tags')->where('name', 'like', "%{$query}%");
    
        if (!empty($tagIds)) {
            $stocks->whereHas('tags', function($query) use ($tagIds) {
                $query->whereIn('id', $tagIds);
            });
        }
    
        $stocks = $stocks->get();
    
        $favorites = auth()->user() ? auth()->user()->favorites()->pluck('id')->toArray() : [];
    
        $stocksData = $stocks->map(function($stock) use ($favorites) {
            return [
                'id' => $stock->id,
                'name' => $stock->name,
                'imagePath' => $stock->imagePath,
                'price' => $stock->price,
                'tags' => $stock->tags,
                'is_favorite' => in_array($stock->id, $favorites),
            ];
        });
    
        return response()->json(['data' => $stocksData]);
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
        $stock->number = $request->number;
        if ($request->hasFile('imagePath')) {
            $filePath = $request->file('imagePath')->store('public/images');
            $fileName = str_replace('public/images/', '', $filePath);
            $stock->imagePath = $fileName;
        }

        $stock->save();

        $descriptions = array_filter(array_map('trim', explode(' ', $request->input('descriptions', ''))));
        foreach ($descriptions as $description) {
            ProductDescription::create([
                'stock_id' => $stock->id,
                'description' => $description
            ]);
        }

        $tagIds = $request->input('tags', []);
        $stock->tags()->sync($tagIds);
        
        return redirect()->back()->with('message', '新しい商品を追加しました');
    }

    public function delete($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();
        return redirect()->route('stock.index')->with('message', '商品を削除しました');
    }



    public function myCart()
    {
        if (Auth::check()) {
            // ログインユーザーのカートアイテムを取得
            $user_id = Auth::id();
            $myCartStocks = UserStock::with('stock')->where('user_id', $user_id)->get();
        } else {
            // 未ログインユーザーの場合、セッションからカートアイテムを取得
            $cart = session()->get('cart', []);
            $myCartStocks = collect(); // コレクションを初期化
            
            // セッションからのカートアイテムをコレクションに追加
            foreach ($cart as $item) {
                $myCartStocks->push((object) [
                    'stock' => Stock::find($item['stock_id']), // Stockモデルからアイテムを取得
                    'quantity' => $item['quantity'],
                ]);
            }
        }
    
        return view('myCart', ['myCartStocks' => $myCartStocks]);
    }
    
    

    public function addMyCart(Request $request)
    {
        $stock_id = $request->input('stock_id');
        $quantity = $request->input('quantity');
    
        if (Auth::check()) {
            // ログイン済みの場合、データベースに保存
            $user_id = Auth::id();
            $cartItem = UserStock::where('user_id', $user_id)->where('stock_id', $stock_id)->first();
    
            if ($cartItem) {
                $cartItem->quantity += $quantity;
                $cartItem->save();
            } else {
                UserStock::create([
                    'user_id' => $user_id,
                    'stock_id' => $stock_id,
                    'quantity' => $quantity,
                ]);
            }
        } else {
            // 未ログインユーザーの場合、セッションにカート情報を保存
            $cart = session()->get('cart', []);
            
            // 既に同じ商品がカートに存在する場合、数量を加算
            $itemIndex = array_search($stock_id, array_column($cart, 'stock_id'));
            if ($itemIndex !== false) {
                $cart[$itemIndex]['quantity'] += $quantity;
            } else {
                $cart[] = ['stock_id' => $stock_id, 'quantity' => $quantity];
            }
    
            session()->put('cart', $cart); // セッションに保存
        }
    
        return redirect()->back()->with('message', 'カートに追加しました');
    }
    

    

    

        public function updateCart(Request $request, $id)
    {
        $user_id = Auth::id();
        $quantity = $request->input('quantity'); // デフォルトは1

        $cartItem = UserStock::where('id', $id)->where('user_id', $user_id)->firstOrFail();

        // 数量を更新
        $cartItem->quantity = $quantity; // ここで新しい数量を設定
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
    
    public function checkout()
    {
        if (Auth::check()) {
            // ログインユーザーのカートアイテムを取得
            $user_id = Auth::id();
            $cartItems = UserStock::with('stock')->where('user_id', $user_id)->get();
        } else {
            // 未ログインユーザーの場合、セッションからカートアイテムを取得
            $cart = session()->get('cart', []);
            $cartItems = collect(); // コレクションを初期化
            
            // セッションからのカートアイテムをコレクションに追加
            foreach ($cart as $item) {
                $cartItems->push((object) [
                    'stock' => Stock::find($item['stock_id']), // Stockモデルからアイテムを取得
                    'quantity' => $item['quantity'],
                ]);
            }
        }
    
        // 合計金額を計算
        $totalPrice = $cartItems->sum(function($item) {
            return $item->stock->price * $item->quantity;
        });
    
        return view('checkout', ['cartItems' => $cartItems, 'totalPrice' => $totalPrice]);
    }
    
    
    public function purchaseComplete(Request $request)
    {
        $user_id = Auth::id();
        
        if (!$user_id) {
            return redirect()->route('login')->with('error', 'ログインが必要です');
        }
    
        $cart = session()->get('cart', []);
        
        foreach ($cart as $item) {
            UserStock::updateOrCreate(
                ['user_id' => $user_id, 'stock_id' => $item['stock_id']],
                ['quantity' => DB::raw("quantity + {$item['quantity']}")]
            );
        }
        
        // セッションカートをクリア
        session()->forget('cart');
        
        return redirect()->intended(route('stock.myCart'));
    }
    



   
    
};