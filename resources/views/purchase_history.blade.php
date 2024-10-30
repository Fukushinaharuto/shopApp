@extends('layouts.layout')

@section('content')
<style>

.purchase-item {
    max-width: 1200px;
    box-sizing: border-box;
    
    margin: 0 auto;
    
}

.purchase-item p {
    margin: 0;
}

.purchase-details {
    display: flex; /* 子要素をフレックスコンテナとして扱う */
    flex-direction: column; /* 子要素を縦に並べる */
    align-items: center; /* 子要素を中央に配置 */
    background-color: white;
    padding: 30px;
    border-bottom-left-radius: 30px;
    border-bottom-right-radius: 30px;
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
    padding-bottom:20px; 
    animation: marquee 5s linear infinite alternate;
    color:#cccccc;
}

.purchase-area{
    padding: 30px 0;
    width: 100%;
    background-color:#ffff77;

}

.purchase-header{
    max-width: 1200px;
    background-color:#bcddff;
    padding: 30px;
    margin-top:20px; 
    border-top-right-radius: 30px;
    border-top-left-radius: 30px;
    font-size:25px;
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

.no-purchase-area{
    background-color:#ffff77; 
    height:330px;
    align-items: center; /* 垂直方向にも中央に配置 */
}
.no-purchase{
    font-size:40px;
    margin: ;
}
</style>

<h1 class="Product-list">Order History</h1>

@if ($purchases->isEmpty())
    <div class="no-purchase-area">
        <p class="no-purchase" >購入履歴はありません。</p>
    </div>
@else
<div class="purchase-area">
    @foreach ($purchases as $purchase)
    
        <div class="purchase-item">
            <div class="purchase-header">
                <h2 style="padding-bottom:10px;">購入日時: {{ $purchase->created_at->format('Y') }}年{{ $purchase->created_at->format('m') }}月{{ $purchase->created_at->format('d') }}日{{ $purchase->created_at->format('H') }}時{{ $purchase->created_at->format('i') }}分</h2>
                <p>合計金額: ¥{{ number_format($purchase->total_price) }}</p>
            </div>
            <div class="purchase-details">
            
            @foreach (json_decode($purchase->items) as $item)
                <div class="item">
                    @if (isset($item->imagePath))
                        <img src="{{ asset('storage/images/' . $item->imagePath) }}" alt="画像">
                    @else
                        <img src="{{ asset('storage/images/default.jpg') }}" alt="デフォルト画像"> <!-- デフォルト画像を用意する -->
                    @endif
                    <div class="info">
                        <p><strong>商品名:</strong> {{ $item->name }}</p>
                        <p><strong>価格:</strong> ¥{{ number_format($item->price) }}</p>
                        <p><strong>数量:</strong> {{ $item->quantity }}</p>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    @endforeach
</div>
@endif



@endsection
