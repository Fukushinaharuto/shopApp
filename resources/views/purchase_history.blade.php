@extends('layouts.layout')

@section('content')
<style>

.purchase-item {
    max-width: 780px; /* 最大幅を指定 */
    box-sizing: border-box;
    border: 2px solid black;
    padding: 20px 60px;
    margin: 0 auto;
    background-color:white;
}

.purchase-item p {
    margin: 0;
}

.purchase-details {
    margin-top: 20px;
    display: flex; /* 子要素をフレックスコンテナとして扱う */
    flex-direction: column; /* 子要素を縦に並べる */
    align-items: center; /* 子要素を中央に配置 */
}

.purchase-details h3 {
    font-size: 24px;
    margin-bottom: 10px;
}

.purchase-details .item {

        display: flex;
    align-items: center; /* アイテムを中央に配置 */
    margin-bottom: 10px;
}

.purchase-details img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    margin-right: 20px;
}

.purchase-details .info {
    display: flex;
    flex-direction: column;
    justify-content: center;
}
</style>

<h1>購入履歴</h1>

@if ($purchases->isEmpty())
    <p>購入履歴はありません。</p>
@else
    @foreach ($purchases as $purchase)
        <div class="purchase-item">
            <h2>購入日時: {{ $purchase->created_at->format('Y-m-d H:i') }}</h2>
            <p>合計金額: {{ number_format($purchase->total_price) }}円</p>

            <div class="purchase-details">
            <h3>購入商品詳細</h3>
            @foreach (json_decode($purchase->items) as $item)
                <div class="item">
                    @if (isset($item->imagePath))
                        <img src="{{ asset('storage/images/' . $item->imagePath) }}" alt="画像">
                    @else
                        <img src="{{ asset('storage/images/default.jpg') }}" alt="デフォルト画像"> <!-- デフォルト画像を用意する -->
                    @endif
                    <div class="info">
                        <p><strong>商品名:</strong> {{ $item->name }}</p>
                        <p><strong>価格:</strong> {{ number_format($item->price) }}円</p>
                        <p><strong>数量:</strong> {{ $item->quantity }}</p>
                    </div>
                </div>
    @endforeach
</div>
        </div>
    @endforeach
@endif

<a href="{{ url('/') }}">ホームに戻る</a>
@endsection
