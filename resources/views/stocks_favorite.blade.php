@extends('layouts.layout')

@section('content')
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>
img {
    width: 100%;
    height: 100%;
    object-fit: cover;

}
.favorite_img {
    border-radius: 50%;
}
.wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: 2%; /* スペースを追加 */
    justify-content: space-between;
    margin: 20px auto;
    max-width: 1200px;
}

/* 商品コンテナ */
.stock-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 3%;
    justify-content: center;
    max-width: 90%;
    margin: 0 auto;
    grid-auto-rows: 1fr;
}

/* 各商品アイテム */
.stock-item {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    max-width: 100%;
    box-sizing: border-box;
    border: 2px solid black;
    padding: 5%;
    text-align: center;
    height: 100%;
    background-color: white;
    overflow: hidden; /* 商品アイテム内で要素が溢れないようにする */
}
.beside {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.beside h3 {
    font-size: 200%;
}

.button {
    margin-top: 10px;
}

.pege {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}
.stock-area {
    flex: 3;
    min-width: 300px;
    margin-left: 20px; /* 検索フォームとの余白 */
    background-color: #ffffe0;
    box-sizing: border-box; /* 要素のサイズをborderとpaddingを含めて計算 */
    overflow: hidden; /* 背景を超えないようにする */
    padding-bottom:50px;
}
</style>


<div class="wrapper">
    <div class="stock-area">
        <div class="stock-container">
        @foreach($stocks as $stock)
            <a href="{{ route('stock.detail', ['id' => $stock->id]) }}">
                <div class="stock-item">
                    <div class="beside">
                        <h3>{{$stock->name}}</h3>
                        <p class="price">{{$stock->price}}円</p>
                        <form action="{{ route('favorite.remove', ['stock_id' => $stock->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; cursor: pointer;">
                                <i class="fa fa-heart" style="color: #ff0000; font-size: 24px;"></i> <!-- 赤いハート -->
                            </button>
                        </form>
                    </div>
                    <img src="{{ asset('storage/images/' . $stock->imagePath) }}" alt="画像" class="favorite_img">
                </div>
            </a>
        @endforeach
        </div>
    </div>
</div>
<div class="pege">{{ $stocks->links() }}</div>

@endsection
