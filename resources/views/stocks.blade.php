@extends('layouts.layout')
@section('content')

<style>
/* 検索フォーム全体のスタイル */
.search-form {
    max-width: 1000px;
    margin: 20px auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    border-radius: 12px;
    background-color: #f8f8f8;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    flex-wrap: wrap; /* レスポンシブ対応で折り返す */
}

/* 検索ボックスのスタイル */
.search-form input[type="text"] {
    flex: 2;
    padding: 12px;
    border: 2px solid #ddd;
    border-radius: 8px;
    margin-right: 15px;
    font-size: 16px;
    transition: border-color 0.3s ease;
}

/* タグのチェックボックスのスタイル */
.tag-checkboxes {
    flex: 2;
    margin-left: 15px;
    margin-top: 10px; /* スペースを追加 */
}

.tag-checkboxes div {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.tag-checkboxes input[type="checkbox"] {
    margin-right: 10px;
    accent-color: #3498db;
}

/* タグラベルのスタイル */
#tagLabel {
    cursor: pointer;
    color: #3498db;
    font-size: 18px;
    font-weight: bold;
    margin-right: 10px;
    white-space: nowrap;
}

#tagLabel:hover {
    color: #2e86c1;
}

/* ページングのスタイル */
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

/* 商品コンテナ */
.stock-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(25%, 1fr));
    gap: 8%;
    justify-content: center;
    max-width: 100%;
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
    border: 1px solid #dcdcdc;
    padding: 5%;
    text-align: center;
    height: 100%; /* 高さを100%に固定 */
    background-color: #fff9f4;
    overflow: hidden; /* 商品アイテム内で要素が溢れないようにする */
}

/* 画像のスタイル */
img {
    width: 100%;
    height: 100%;
    object-fit: cover;

}

.store_img{
    border-radius: 50%;
}

.beside {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.beside h3 {
    font-size: 200%;
}

/* 検索ボタンのスタイル */
.search-form button:hover,
.search-form a:hover {
    background-color: #3498db;
}

.search-form a {
    margin-top: 10px;
    color: #3498db;
    text-decoration: none;
}



/* 全体のコンテナ */
.wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: 2%; /* スペースを追加 */
    justify-content: space-between;
    margin: 0 auto;
    max-width: 1200px;
}

/* 検索フォームエリア */
.search-area {
    flex: 1;
    min-width: 300px; /* 小さい画面での最小幅を設定 */
    margin-right: 20px; /* 右側に余白を追加 */
}

/* 固定されるときの検索フォームスタイル */
.search-input{
    display: flex;
    justify-content: center;
}

/* 商品エリア */
.stock-area {
    flex: 3;
    min-width: 300px;

    background-color: white;
    box-sizing: border-box; /* 要素のサイズをborderとpaddingを含めて計算 */
    overflow: hidden; /* 背景を超えないようにする */
    padding-bottom:50px;
}
.search-area {
        position: fixed;
        top: 100px;
        left: 30px;
        width: 10%;
    }

.heading{
    padding:10px 0 10px 5%;
    font-size:40px;
    text-align:left;
    background-color:#ffffe0;
    margin-bottom:30px;
    

}

.delete_buttom{
    padding-top:40px;
}
/* レスポンシブデザイン */
@media (max-width: 768px) {
    .wrapper {
        flex-direction: column;
    }
}

</style>
    <div class="title">
      <div class="title_img">
        <img src="{{ asset('storage/images/title_img.png') }}" alt="まごころはーぶ">
      </div>
    </div>

<div class="wrapper">
    <!-- 検索フォームエリア -->

    <div class="search-area" id="search" style="display:none;">
        <div class="search-form">
            <details>
                <summary id="status">
                    検索表示
                </summary>
                
                    <form action="{{ route('stock.index') }}" method="GET">
                        <input type="text" name="query" class="search-input" placeholder="商品名で検索" value="{{ request()->input('query') }}">
                        
                        <div class="form-group">
                            {{-- <label id="tagLabel">タグ一覧を表示</label> --}}
                            <div id="tagCheckboxes" class="tag-checkboxes">
                                @foreach($tags as $tag)
                                    <div>
                                        <input type="checkbox" id="filterTag{{ $tag->id }}" name="tag_id[]" value="{{ $tag->id }}" 
                                        {{ in_array($tag->id, request('tag_id', [])) ? 'checked' : '' }}>
                                        <label for="filterTag{{ $tag->id }}">{{ $tag->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit">検索</button>
                    </form>
                    
                
            </details>
            <a href="{{ route('stock.index') }}">リセット</a>
        </div>
    </div>
    <!-- 商品一覧エリア -->
    <div style="background-color:white; padding:40px; ">
        <div class="stock-area">

                <div class="heading">
                    <h1>ブレンド Herb tea</h1>
                </div>

                
            @if($user->role_flag === 0)
                <form action="{{ route('stock.delete')}}" method="POST">
                    @csrf
                    @method('DELETE')
            @endif
            <div class="stock-container">
                @foreach($stocks as $stock)
                    <a href="{{ route('stock.detail', ['id' => $stock->id]) }}">
                        <div class="stock-item">
                            <div class="beside">
                                @if($user->role_flag === 0)
                                        <input type="checkbox" name="stock_ids[]" value="{{ $stock->id }}">
                                @endif
                                <h3 style="font-size:100%;">{{$stock->name}}</h3>
                                
                                @if (in_array($stock->id, $favorites))
                                    <form action="{{ route('favorite.remove', ['stock_id' => $stock->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: none; border: none; cursor: pointer;">
                                            <i class="fa fa-heart" style="color: #ff0000; font-size: 24px;"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('favorite.add', ['stock_id' => $stock->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" style="background: none; border: none; cursor: pointer;">
                                            <i class="fa fa-heart" style="color: #ccc; font-size: 24px;"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                            <img src="{{asset('storage/images/' . $stock->imagePath)}}" alt="画像" class="store_img">
                            <p class="price">{{$stock->price}}円</p>
                        </div>
                    </a>
                @endforeach
            </div>
            @if($user->role_flag === 0)
                    <button type="submit" class="delete_buttom">選択した商品を削除</button>
                </form>
            @endif
        </div>
    </div>
</div>

<div class="pege">{{$stocks->links()}}</div>

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
    const details = $('details');
    const statusP = $('#status');

    $(window).on('scroll', function() {
        // スクロール量が100pxを超えたら検索フォームを表示し、それ未満なら非表示にする
        if ($(window).scrollTop() > 500) {
            $("#search").show();  // display: none; を削除して表示
        } else {
            $("#search").hide();  // display: none; を適用して非表示
        }
    });

    // detailsタグの状態を切り替えた際の表示を更新
    $('details').on('toggle', function() {
        const isOpen = $(this).prop('open');
        $('#status').text(isOpen ? '検索非表示' : '検索表示');
    });


</script>


@endsection
