@extends('layouts.layout')

@section('content')
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>
img {
    width: 260px;
    height: 180px;
    object-fit: cover;
}
.wrapper {
    display: flex;
    justify-content: center; /* 全体を中央に配置 */
}

/* 商品コンテナ */
.stock-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); /* 300px 幅のアイテムを自動配置 */
    gap: 20px; /* アイテム間のスペース */
    justify-content: center; /* コンテナ全体を中央に配置 */
    max-width: 1200px; /* 必要に応じて幅を調整 */
    margin: 0 auto;
}

/* 各商品アイテム */
.stock-item {
    max-width: 300px; /* 最大幅を指定 */
    box-sizing: border-box;
    border: 1px solid #ddd;
    padding: 20px;
    text-align: center;
}
.beside {
    display: flex;
    justify-content: space-between; /* アイテムを両端に配置 */
    align-items: center; /* 垂直方向に中央揃え */
}

.beside h3 {
    font-size: 25px;
}

.button {
    margin-top: 10px;
}

.pege {
    margin: 20px;
}
</style>

<div class="search-form">
    <form action="{{ route('stock.search') }}" method="GET">
        <input type="text" name="query" placeholder="商品名で検索" value="{{ request()->input('query') }}">
        <button type="submit">検索</button>
    </form>
</div>

<div class="wrapper">
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
                <img src="{{ asset('storage/images/' . $stock->imagePath) }}" alt="画像">
            </div>
        </a>
    @endforeach
    </div>
</div>
<div class="pege">{{ $stocks->links() }}</div>

@endsection
