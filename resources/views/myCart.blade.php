@extends('layouts.layout')

@section('content')
<style>
.cart_name{
    text-align:left;
    font-size: 30px;
}

.cart-item {
    background-color:white;
    max-width: 780px; /* 最大幅を指定 */
    box-sizing: border-box;
    border: 2px solid black;
    padding: 20px 60px;
    text-align: center;
    display:flex;
    margin: 0 auto;
}
.cart_text{
    padding-left:40px;
}
img{
    width: 260px;
    height: 180px;
    object-fit: cover;
}
.cart-area{

    justify-content: space-between;
    margin: 0 auto;
    max-width:1200px;
    background-color: #ffffe0;
    box-sizing: border-box; /* 要素のサイズをborderとpaddingを含めて計算 */
    overflow: hidden; /* 背景を超えないようにする */
    padding-bottom:50px;
}
</style>


@if ($myCartStocks->isEmpty())
    <p>カートは空です。</p>
@else
    <div class="cart-area">
        @foreach ($myCartStocks as $cartItem)
            @if ($cartItem->stock)
                <div class="cart-item">
                    <div>

                        <img src="{{asset('storage/images/' . $cartItem->stock->imagePath)}}" alt="画像">
                    </div>
                    <div class="cart_text">
                        <div class="">
                            <h2 class="cart_name">{{ $cartItem->stock->name }}</h2>
                            <p>{{ $cartItem->stock->price }}円</p>
                        </div>
                        <form action="{{ route('cart.update', $cartItem->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <p>購入個数 :
                                <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1">
                            </p>
                            <button type="submit">更新</button>
                        </form>
                        <form action="{{ route('cart.delete', $cartItem->id)}}" method="POST" style="margin-top:10px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('この商品を削除してもよろしいですか？');">削除</button>
                        </form>

                    </div>
                </div>
            @else
                <p>商品情報がありません</p>
            @endif
        @endforeach
        @if (!$myCartStocks->isEmpty())
        <form action="{{ route('cart.purchase') }}" method="POST">
            @csrf
            <button type="submit">購入する</button>
        </form>
        @endif
    </div>
@endif

<a href="{{ url('/') }}">買い物を続ける</a>
@endsection
