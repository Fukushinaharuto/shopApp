@extends('layouts.layout')

@section('content')
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>
.pege {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pege .pagination {
    display: flex;
    list-style: none;
}

.pege .pagination li {
    margin: 0 5px;
}

.pege .pagination li a {
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    color: #3498db;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.pege .pagination li a:hover {
    background-color: #3498db;
    color: white;
}

img {
    width: 100%;
    height: 100%;
    object-fit: cover;

}
.store_img{
    width: 270px; /* 画像の幅を小さく設定 */
    height: 175px; /* アスペクト比を保つ */
    object-fit: cover;
    border-radius: 50%;

    position: absolute;

    bottom: 20px; /* 親要素の下端に配置 */

}
.wrapper {

    flex-wrap: wrap;
    gap: 2%; /* スペースを追加 */
    justify-content: space-between;
    margin: 0 auto;

}

.stock-container {
    display: flex;
    gap: 16px;
    padding: 10px;
    box-sizing: border-box;
    width: 100%; /* 全体の幅を100%に設定 */
    max-width: 1200px; /* 最大幅を設定 */
    overflow-x: auto; /* 横スクロールを有効化 */

    margin: 0 auto; /* 中央揃え */

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


/* 各商品アイテム */


.item-top{
    word-wrap:break-all;
    display: flex;
    flex-direction: column;
    position: relative; /* 子要素のposition基準 */
    padding: 30px;
    height: 270px; /* 高さを固定 */
    width: 330px;
    border-top-left-radius: 30px;
    border-top-right-radius: 30px;
}

.item-bottom {
    border-bottom-left-radius: 30px;
    border-bottom-right-radius: 30px;
    margin-top: auto; /* 上の余白を自動調整して下にくっつける */
    text-align: center; /* 中央揃え */

    background-color: white; /* 背景色を設定 */
    
    position: relative; /* 基準位置を設定 */
    padding: 30px 20px 50px; /* 下部の余白を増やして内容が重ならないように */
    white-space: nowrap;
    height: 180px; /* 高さを固定 */
    width: 330px;
}
.beside {
    text-align:right;
    position: absolute;
    right: 20px; /* 親要素の内側に配置 */
    bottom: 20px; /* 親要素の下端に配置 */
}

.stock-name{
    font-size:20px;
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

    background-color: #ffff77;
    margin-top: 10px;
    padding: 30px 0;
}
.heading{
    padding:10px 0 10px 5%;
    font-size:40px;
    text-align:left;
    background-color:#ffffe0;
    margin-bottom:30px;
    

}
.color-1 {
    background-color: #f8d7da;
}

.color-2 {
    background-color: #d4edda;
}

.color-3 {
    background-color: #d1ecf1;
}

.delete_buttom{
    margin-top:15%;
}


.price{
    font-size: 16px; /* 必要に応じてサイズを調整 */
    color: #333; /* テキストの色を設定 */
    transform: translate(-50%, -50%); /* 中央に配置 */
    position: absolute; /* 絶対位置指定 */
    right: 10%; /* 親要素の右端に配置 */
    bottom: 20%; /* 親要素の下端に配置 */
    font-size:18px;
}
.tag-name{
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%); /* 中央に配置 */
}

</style>


<div class="wrapper">

    
        <h1 class="Product-list">Liked Items</h1>


 

        <div class="stock-area">     
            <div class="stock-container">

                @foreach($stocks as $stock)
                    <a href="{{ route('stock.detail', ['id' => $stock->id]) }}" style="border-radius: 30px;">
                        
                            <div class="item-top {{ 'color-' . ($loop->index % 3 + 1) }}">
                                
                                    <h3 class="stock-name">{{$stock->name}}</h3>
                               
                               
                            
                                <img src="{{ asset('storage/images/' . $stock->imagePath) }}" alt="画像" class="store_img">
                                <div class="beside">
                                    

                                        <form action="{{ route('favorite.remove', ['stock_id' => $stock->id]) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background: none; border: none; cursor: pointer;">
                                                <i class="fa fa-heart" style="color: #ff0000; font-size: 24px;"></i>
                                            </button>
                                        </form>
         
                                </div>
                            </div>
                            <div class="item-bottom">
                                
                                <ul class="tag-name">
                                    @foreach($stock->tags as $tag)
                                        <li>★{{ $tag->name }}</li>
                                    @endforeach
                                </ul>
                                
                           
                                <p class="price">¥{{$stock->price}}</p>
                            </div>
     

                        
                    </a>
                @endforeach
            </div>
            
        </div>

<script>





$(document).ready(function () {
    const $container = $('.stock-container');
    const $items = $container.children();
    const itemCount = $items.length;

    const totalScrollWidth = itemWidth * itemCount; // 全体のスクロール幅

    // アイテムを複製


    // スクロール量
    const scrollAmount = itemWidth; // 最初のアイテムの幅を取得

    // マウスホイールイベントで横スクロールを実現
    $container.on('wheel', function (event) {
        event.preventDefault(); // デフォルトの縦スクロールを防ぐ

        // スクロール方向に応じてスクロール位置を調整
        const delta = event.originalEvent.deltaY; 
        if (delta > 0) {
            // 右にスクロール
            $(this).scrollLeft($(this).scrollLeft() + scrollAmount);
        } else {
            // 左にスクロール
            $(this).scrollLeft($(this).scrollLeft() - scrollAmount);
        }
    });

    // stock-item 内でのホイールイベントを無効化
    $items.on('wheel', function (event) {
        event.stopPropagation(); // イベントのバブリングを停止
    });


});




</script>
@endsection
