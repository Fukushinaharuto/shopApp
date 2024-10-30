@extends('layouts.layout')

@section('content')
<style>
.cart_name{
    text-align:left;
    font-size: 30px;
}

.cart-item {
    background-color:white;


}
.cart_text{
    padding-left:40px;
}
img{
    width: 260px;
    height: 180px;
    object-fit: cover;

    border-radius: 30px;
}
.cart-area{
    margin-top: 10px;
    padding: 30px 0;
    justify-content: space-between;
    margin: 0 auto;
    background-color:#ffff77;


    padding-bottom:50px;
}

.heading{
    padding:10px 0 10px 5%;
    font-size:40px;
    text-align:left;
    background-color:#ffffe0;
    margin-bottom:30px;
    

}

.Product-list {
    display: inline-block;
    font-size: 80px;
    
    animation: marquee 8s linear infinite alternate;
    color:#cccccc;
    
}

    /* アニメーションの詳細 */
    @keyframes marquee {
    0% {
        transform: translateX(-100%);
    }
    100% {
        transform: translateX(100%);
    }
    }
.able-of-ontents{
    background-color:#bcddff;
    
    
}

.table-area {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    border-spacing: 0 20px;
    border-collapse:separate;

}

.table-area th{
    font-size:20px;
    padding: 20px; /* thの内側余白を増やす */
}
.table-area td{
    padding: 25px 20px; /* tdセルの追加余白 */
}

.table-area th, .table-area td {
    padding: 15px;
    text-align: center;
    vertical-align: middle; /* 上下中央揃え */
    padding: 25px; /* 各セルの内側余白 */
}

.no-stock{
    font-size:40px;

}
    
.no-stock-area{

    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ffff77;
    width: 100%;
    height: 400px;
}
    
.buy-buttom{
    padding:20px 40px;
    border-radius: 20px;
    background-color:#ffadd6;
    font-size: 23px;
    color: white;
    
}

</style>

<h1 class="Product-list">Purchase confirmed</h1>
@if ($myCartStocks->isEmpty())
<h1 class="Product-list">Purchase confirmation</h1>
    <div class="no-stock-area">
        <p class="no-stock">購入確認は空です。</p>
    </div>
    
@else
    <div>
        

        <div class="cart-area">
            <table class="table-area">
                <tr class="able-of-ontents">
                    <th style="border-top-left-radius: 30px; border-bottom-left-radius: 30px;"></th>
                    <th>商品名</th>
                    <th>数量</th>
                    <th>価格</th>
                    <th style="border-top-right-radius: 30px; border-bottom-right-radius: 30px;"></th>
                </tr>
            @foreach ($myCartStocks as $cartItem)
                @if ($cartItem->stock)
                    
                        
                            <tr class="cart-item">
                                <td style="border-top-left-radius: 30px; border-bottom-left-radius: 30px;"><img src="{{asset('storage/images/' . $cartItem->stock->imagePath)}}" alt="画像"></td>
                                <td><h2 class="cart_name">{{ $cartItem->stock->name }}</h2></td>
                                <td><form action="{{ route('cart.update', $cartItem->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                        <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1">
                                        
                                    <button type="submit">変更</button>
                                </form>
                                </td>
                                <td style="font-size:20px;">¥{{ $cartItem->stock->price }}</td>
                                <td style="border-top-right-radius: 30px; border-bottom-right-radius: 30px;"><form action="{{ route('cart.delete', $cartItem->id)}}" method="POST" style="margin-top:10px;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('この商品を削除してもよろしいですか？');" style="white-space: nowrap;"><i class="fa-solid fa-trash"></i>削除</button>
                                </form>
                                </td>
                            </tr>
                        
            

                            
                   
                       
                @else
                    
                        <p>商品情報がありません</p>
                    
                    
                @endif
            @endforeach
            </table>
            @if (!$myCartStocks->isEmpty())
            <form action="{{ route('cart.purchase') }}" method="POST">
                @csrf
                <div style="padding-top:30px ">
                    <button type="submit" class="buy-buttom" onclick="return confirm('本当に購入してよろしいですか？')">購入を確定する</button>
                </div>
            </form>
            @endif
        </div>

        
    </div>
@endif


@endsection
