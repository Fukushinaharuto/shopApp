@extends('layouts.layout')
@section('content')

<style>
/* 検索フォーム全体のスタイル */


/* 商品コンテナ */
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

    .slide-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(255, 255, 255, 0.8);
        border: none;
        font-size: 30px;
        cursor: pointer;
        z-index: 1;
    }

    .prev-btn {
        left: 10px;
    }

    .next-btn {
        right: 10px;
    }

/* 画像のスタイル */
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

.beside {
    text-align:right;
    position: absolute;
    right: 20px; /* 親要素の内側に配置 */
    bottom: 20px; /* 親要素の下端に配置 */
}

.beside h3 {
    font-size: 200%;
}

/* 検索ボタンのスタイル */




/* 全体のコンテナ */


/* 検索フォームエリア */


/* 固定されるときの検索フォームスタイル */


/* 商品エリア */




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
.title{
    max-width:100%;

}
/* レスポンシブデザイン */
@media (max-width: 768px) {
    .wrapper {
        flex-direction: column;
    }
    .search-input {
        width: 100%; /* 小さい画面の場合は100%幅にする */
    }
}
.tag-name{
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%); /* 中央に配置 */
}

.title_img{
    max-width: 80%
}

.stocks-area{
    background-color: #ffff77;
    margin-top: 10px;
    padding: 30px 0;
    
    
}   




    /* タイトルのアニメーション */
    .Product-list {
    display: inline-block;
    font-size: 80px;
    padding-top:30px;
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
.stock-name{
    font-size: 20px;
    word-wrap:break-all;
    /* overflow:auto; */
   
}

.search-area {
    max-width: 1200px;
    background-color: white; /* 背景色を設定 */
    padding: 30px; /* 内側の余白を設定 */
    border-radius: 30px;
    justify-content: center;
    margin: 30px auto; /* 上下に30px、左右に自動マージン */

    
}
.tag-checkboxes {
    display: flex; /* フレックスボックスを有効にする */
    flex-wrap: wrap; /* 要素が折り返すようにする */
    gap: 16px; /* 子要素間の隙間 */
}

.tag-checkboxes div {
    flex: 1 0 150px; /* 最小幅150pxのフレックスアイテム */
    display:flex;
    align-items: center;
    height:40px;
}
.tags-area{
    text-align:left;
    padding-left:8px;
}
details {



}
summary {
    margin-left:80%;
    list-style: none; /* デフォルトのリストスタイルを無効化 */
    cursor: pointer; /* ポインターを表示 */
    
    display: flex; /* フレックスボックスを利用 */
    align-items: center; /* 縦方向の中央揃え */
    justify-content: center; /* 横方向の中央揃え */
    
    background-color: white; /* 背景色を指定 */
    border-radius: 50%;
    
    font-size: 24px; /* フォントサイズを指定 */
    border: 2px solid #333; /* 枠線を指定 */
    width: 60px; /* 幅を指定 */
    height: 60px; /* 高さを指定 */

}

summary i {
    margin: 0; /* アイコンの余白を削除 */
    font-size: 24px; /* アイコンのサイズを指定 (必要に応じて調整) */
}


summary::-webkit-details-marker {
    display: none; /* Chrome系ブラウザの矢印を非表示にする */
}

.search-input {
    width: 500px; /* ここを希望のサイズに変更 */
    margin-top:10px;
    margin-bottom:20px;
}

</style>

    
    <div class="title">
        <div class="title_img">
            <img src="{{ asset('storage/images/title_img.png') }}" alt="まごころはーぶ">
        </div>
    </div>


    <!-- 検索フォームエリア -->

    
    

        <h1 class="Product-list">Product List</h1>
    <!-- 商品一覧エリア -->
    <div class="stocks-area">
        
            
                    <details>
                        <summary id="status">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </summary>
                        
                            <div class="search-area">
                                <form action="{{ route('stock.index') }}" method="GET" >
                                    
                                        <input type="text" name="query" class="search-input" placeholder="商品名で検索" value="{{ request()->input('query') }}">
                                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    
                                    <a href="{{ route('stock.index') }}" style="color:blue;">リセット</a>
                                    <div class="form-group">
                                        {{-- <label id="tagLabel">タグ一覧を表示</label> --}}
                                        <div id="tagCheckboxes" class="tag-checkboxes">
                                            @foreach($tags as $tag)
                                                <div>
                                                    <input type="checkbox" id="filterTag{{ $tag->id }}" name="tag_id[]" value="{{ $tag->id }}" 
                                                    {{ in_array($tag->id, request('tag_id', [])) ? 'checked' : '' }}>
                                                    <div class="tags-area">
                                                        <label for="filterTag{{ $tag->id }}">{{ $tag->name }}</label>
                                                    </div>
                                                    
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
            
                                    
                                </form>
                            </div>
                
                        
                    </details>
                    
               
            
            
            <div class="stock-container">

                @foreach($stocks as $stock)
                    <a href="{{ route('stock.detail', ['id' => $stock->id]) }}" style="border-radius: 30px;">
                        
                            <div class="item-top {{ 'color-' . ($loop->index % 3 + 1) }}">
                                
                                    <h3 class="stock-name">{{$stock->name}}</h3>
                               
                            
                                <img src="{{ asset('storage/images/' . $stock->imagePath) }}" alt="画像" class="store_img">
                                <div class="beside">
                                    
                                    <button class="favorite-toggle" data-stock-id="{{ $stock->id }}" style="background: none; border: none; cursor: pointer;">
                                        @if (in_array($stock->id, $favorites))
                                            <i class="fa fa-heart" style="color: #ff0000; font-size: 24px;"></i> <!-- 既にお気に入り登録済み -->
                                        @else
                                            <i class="fa fa-heart" style="color: #ccc; font-size: 24px;"></i> <!-- お気に入り未登録の空ハート -->
                                        @endif
                                    </button>
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
                            <!-- 削除ボタンを追加 -->
                            @if (!is_null($user))
                                @if($user->role_flag === 0)
                                    <form action="{{ route('stock.delete', ['id' => $stock->id]) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete_buttom">削除</button>
                                    </form>
                                @endif
                            @endif

                        
                    
                @endforeach
            </div>
            

    </div>
</div>

{{-- <div class="pege">{{$stocks->links()}}</div> --}}

{{-- <script>
document.addEventListener('DOMContentLoaded', function() {
    var tagLabel = document.getElementById('tagLabel');
    var tagCheckboxes = document.getElementById('tagCheckboxes');

    tagLabel.addEventListener('click', function() {
        if (tagCheckboxes.style.display === 'none' || tagCheckboxes.style.display === '') {
            tagCheckboxes.style.display = 'block';
        } else {
            tagCheckboxes.style.display = 'none';
        }
    });
});
</script> --}}

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

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.favorite-toggle').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const stockId = this.dataset.stockId;
            const url = `/favorite/toggle/${stockId}`;
            
            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ stock_id: stockId })
            })
            .then(response => response.json())
            .then(data => {
                const icon = this.querySelector('i');
                if (data.status === 'added') {
                    
                    icon.classList.add('fa-heart');
                    icon.style.color = '#ff0000';
                } else if (data.status === 'removed') {
                    
                    icon.classList.add('fa-heart-o');
                    icon.style.color = '#ccc';
                } else if (data.status === 'not_logged_in') {
                    window.location.href = 'login'; // ログインページにリダイレクト
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});






</script>









@endsection
