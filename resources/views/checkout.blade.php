@extends('layouts.layout')

@section('content')
<style>

.checkout-container{
    margin-top: 10px;
    padding: 30px 0;
    justify-content: space-between;
    margin: 0 auto;
    background-color:#d4edda;
    width: 100%;
}
.product-list {
    display: inline-block;
    font-size: 80px;
    
    animation: marquee 3s linear infinite alternate;
    color:#cccccc;
    
}
@keyframes marquee {
    0% {
        transform: translateX(-100%);
    }
    100% {
        transform: translateX(100%);
    }
    }

.table-area {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    border-spacing: 0 20px;
    border-collapse:separate;

}

.able-of-ontents{
    background-color:#ffff77;
    
    
}

.cart-item {
    background-color:white;


}

.cart_name{
    text-align:left;
    font-size: 30px;
}

img{
    width: 260px;
    height: 180px;
    object-fit: cover;

    border-radius: 30px;
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
background-color: #d4edda;
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
.total{
    font-size: 40px;
    margin: 30px 0;
}
</style>
<h1 class="product-list">Cart</h1>
<div class="checkout-container">
    
    <table class="table-area">
        <tr class="able-of-ontents">
            <th style="border-top-left-radius: 30px; border-bottom-left-radius: 30px;"></th>
            <th>商品名</th>
            <th>数量</th>
            <th>価格</th>                    
            <th style="border-top-right-radius: 30px; border-bottom-right-radius: 30px;"></th>
        </tr>
        @foreach ($cartItems as $item)
        <tr class="cart-item">
            <td style="border-top-left-radius: 30px; border-bottom-left-radius: 30px;"><img src="{{asset('storage/images/' . $item->stock->imagePath)}}" alt="画像"></td>
            <td><h2 class="cart_name">{{ $item->stock->name }}</h2></td>
            <td><form action="{{ route('cart.update', isset($item->id) ? $item->id : '') }}" method="POST">

                @csrf
                @method('PUT')
                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1">
                    
                <button type="submit">更新</button>
            </form>
            </td>
            <td style="font-size:20px;">¥{{ $item->stock->price }}</td>
            <td style="border-top-right-radius: 30px; border-bottom-right-radius: 30px;"><form action="{{ route('cart.update', isset($item->id) ? $item->id : '') }}" style="margin-top:10px;" method="POST">

                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('この商品を削除してもよろしいですか？');" style="white-space: nowrap;"><i class="fa-solid fa-trash"></i>削除</button>
            </form>
            </td>
        </tr>
        @endforeach
    </table>
    <p class="total">合計金額: ¥{{ $totalPrice }}</p>
    
    <!-- 購入手続きボタン -->
    <form action="{{ route('cart.purchaseComplete') }}" method="POST">
        @csrf
        <button type="submit" class="buy-buttom">購入手続きへ</button>
    </form>
</div>
@endsection
