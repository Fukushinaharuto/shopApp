@extends('layouts.layout')
@section('content')
<style>
.detail{
    flex: 0 1 300px; /* 固定幅を指定 */

    box-sizing: border-box;
    border: 1px solid #ddd;
    padding: 20px 150px;
    text-align: center;
}
.detail h1{
    font-size:40px;

}
.detail img{
    width: 680px;
    height: 500px;
    object-fit: cover;

}

.price{
    font-size:20px;
}

.beside {
    display: flex;
    justify-content: space-between; /* アイテムを両端に配置 */
    align-items: center; /* 垂直方向に中央揃え */
}

.cart-form {
    margin-top: 20px;
    text-align:right;
}
.quantity {
    width: 35px;
    padding: 0px;
    font-size: 18px;
    margin-right: 10px;
    text-align: center;
}
.alert {
    margin-top:20px;
    background-color: #dff0d8;
    border-color: #d6e9c6;
    color: #3c763d;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 4px;
}

</style>
        @if (session('message'))
            <div id="alert-message" class="alert">
                {{ session('message') }}
            </div>
        @endif
    <div class="detail">



        <div class="beside">
            <h1>{{ $stock->name }}</h1>
            <p class="price">{{ $stock->price }}円</p>
        </div>
        <img src="{{asset('storage/images/' . $stock->imagePath)}}" alt="画像">  
        <p>{{ $stock->explain }}</p>
        <form action="{{ url('addMyCart') }}" method="post" class="cart-form">
            @csrf
            <input type="hidden" name="stock_id" value="{{ $stock->id }}">
            <input type="number" name="quantity" value="1" min="1" class="quantity">
            <input type="submit" value="カートに入れる" class="button">
            
            
        </form>
    </div>

<script>
    // 10秒後にメッセージを消す処理
    setTimeout(function() {
        var alertMessage = document.getElementById('alert-message');
        if (alertMessage) {
            alertMessage.style.display = 'none';
        }
    }, 4000); // 10秒（10000ミリ秒）
</script>


@endsection