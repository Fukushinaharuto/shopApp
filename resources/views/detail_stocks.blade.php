@extends('layouts.layout')
@section('content')
<style>
.detail-area{
    background-color:#ffff77;
    padding-top:30px;
}
.detail-wrapper {
    display: flex;
    align-items: flex-start;
    gap: 20px; /* 画像と詳細の間の余白 */
    margin: 0 auto;
    max-width: 1200px; /* コンテンツの最大幅 */
    background-color:white;
    padding:30px;
    border-radius: 30px;
    
}

.image-container {
    flex: 2; /* 画像エリアの占有率を増やす */
    text-align: center;
}

.image-container img {
    width: 100%;
    height: auto;
    max-width: 100%; /* コンテナ幅いっぱいに画像を広げる */
    object-fit: cover;
    border-radius: 30px; /* 画像に角丸を適用 */
}

.detail {
    flex: 3; /* 詳細エリアの占有率 */
    box-sizing: border-box;
    padding: 20px;
}

.detail h1 {
    font-size: 40px;
}

.price {
    font-size: 20px;
    margin-left: auto; /* 価格を右寄せにする */

}

.beside {
    display: flex;
    justify-content: space-between;
    align-items: center; /* ここを追加して上下中央揃え */
    margin-top:20px;

}

.cart-form {
    
    text-align: right;
    padding-left:10px; 
}

.quantity {
    width: 35px;
    padding: 0px;
    font-size: 18px;
    margin-right: 10px;
    text-align: center;
}

.alert {
    margin-top: 20px;
    background-color: #dff0d8;
    border-color: #d6e9c6;
    color: #3c763d;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 4px;
}

.number {
    border: 1px solid #dcdcdc;
    width: 100%;
}

.description-list {
    column-count: 2;
    column-gap: 1%;
    padding: 0;
    list-style-type: none;
}

.description-list li {
    display: inline-block;
    width: 100%;
    break-inside: avoid;
    padding: 5px 0;
    box-sizing: border-box;
}

.star-rating {
    padding: 10px;
    align-items: center;
    justify-content: center;
    display:flex;
    cursor: pointer;
    font-size: 20px;
    position: relative; /* 配置の基準を相対的に */
    z-index: 1; /* スターが他の要素の下に隠れないようにする */
}

.star-value {
    border-bottom: 2px solid #ffadd6;
    padding: 10px;
    align-items: center;
    justify-content: center;
    display:flex;
    cursor: pointer;
    font-size: 20px;
    position: relative; /* 配置の基準を相対的に */
    z-index: 1; /* スターが他の要素の下に隠れないようにする */
}
.evaluation{
    display: inline-flex;
    cursor: pointer;
    font-size: 20px;
    position: absolute;
    right: 10%; /* 親要素の右端に配置 */
    bottom: 0; /* 親要素の下端に配置 */
    align-items: center; /* 上下中央揃え */
}



.star.selected {
    color: gold; /* 選択された星は金色 */
}

.overall-rating {
    font-size: 30px;
}

.star {
    color: #ccc; /* 未選択時のスター色（グレー） */
    transition: color 0.2s; /* 色が変わるトランジション */
}
.star.filled {
    color: #FFD700; /* 評価がある場合のスター色（黄色） */
}

.point{
    font-size:30px;
    text-align: left;
}
.stock-name{
    font-size: 60px;
    color:#cccccc;
    padding-bottom:10px;
}
.stock-name-area {
    display: flex;
    justify-content: center; /* 商品名を中央に配置 */
    align-items: center;
    position: relative; /* .star-rating の位置を基準にする */
}
.comprehensive-evaluation{
    font-size:15px;
    
}
.button{

    padding:15px 30px;
    border-radius: 20px;
    background-color:#ffadd6;
    font-size: 20px;
    
}

.point-area{
    border-bottom: 2px solid #bcddff;
}

.tag-name-area{
    padding:20px 0;
}
.tag-name-area li{
    padding:5px 0;
}

.review-area{

    max-width: 1200px;
    margin: 0px auto;
    padding:30px;
    border-radius:30px;
}
.review{

    border-bottom: 2px solid #bcddff;
    padding-bottom: 10px;
    font-size: 40px;
    background-color: white;
    margin-top:30px;
    
    
}
.review-flex{
    display:flex;
}
.add-review{
    flex:4;
    padding:30px 0;
    margin-right:10px;
}

.review-value{
    flex:5;
    padding:30px 0;
    margin-left:10px;

}

.review-add-title{
    background-color: #bcddff;
    padding: 20px 0;
    border-top-right-radius: 30px;
    border-top-left-radius: 30px;
}

.review-add-area {
    background-color:white;
    padding:30px;
    border-bottom-right-radius: 30px;
    border-bottom-left-radius: 30px;
}

.review-list-title{
    background-color: #ffadd6;
    padding: 20px;
    border-top-right-radius: 30px;
    border-top-left-radius: 30px;
}

.review-list-area{
    background-color:white;
    padding:30px;
    border-bottom-right-radius: 30px;
    border-bottom-left-radius: 30px;
}

.star-title{
    font-size:20px;
}
.comment{
    font-size:20px;
}

.add-button {

    
    margin-top: 10px; 
    margin-left:55%;/* 左寄せ */
    padding:20px 40px;
    border-radius: 20px;
    background-color:#ffadd6;
    font-size: 15px;
    color: white;
    
    
}
.text-input {
    resize: vertical; /* ユーザーが縦方向にのみリサイズ可能に */
    width: 100%; /* 親要素の幅に合わせる */
    height: 150px; /* 高さを150pxに設定 */
    box-sizing: border-box; /* パディングを含めて計算する */
}

.year{
    padding-left:20%;
    font-size: 15px;
    
}

.review-comment{
    padding: 20px 0;
}

.review-user-name{
    font-size:20px;
    text-align: left;
    padding-left:10%;
    margin-top:10px;
}

</style>

@if (session('message'))
    <div id="alert-message" class="alert">
        {{ session('message') }}
    </div>
@endif
<div class="stock-name-area">
    <h1 class="stock-name">{{ $stock->name }}</h1>
    
    <div class="evaluation">
        <span class="comprehensive-evaluation">{{ number_format($overallRating, 2) }}</span>
        @for ($i = 1; $i <= 5; $i++)
            <span class="star {{ $i <= $overallRating ? 'filled' : '' }}">★</span>
        @endfor
        <span style="font-size:15px;">({{ $stock->reviews->count() }})</span>
        
    </div>
</div>
<div class="detail-area">
    <div class="detail-wrapper">
        <div class="image-container">
            <img src="{{ asset('storage/images/' . $stock->imagePath) }}" alt="画像">
        </div>

        <div class="detail">
            
            <div class="point-area">
                <h2 class="point">Point</h2>
            </div>
            
            <ul class="tag-name-area">
                @foreach($stock->tags as $tag)
                    <li>★{{ $tag->name }}</li>
                @endforeach
            </ul>

            <div class="number">
                <p>NO.{{ $stock->number }}/BLEND</p>
            </div>

            <ul class="description-list">
                @foreach ($stock->descriptions as $description)
                    <li>{{ $description->description }}</li>
                @endforeach
            </ul>
            <div class="beside">
                <p class="price">単価：¥{{ $stock->price }}</p>
                <form action="{{ url('addMyCart') }}" method="post" class="cart-form">
                    @csrf
                    <input type="hidden" name="stock_id" value="{{ $stock->id }}">
                    <input type="number" name="quantity" value="1" min="1" class="quantity">

                    <input type="submit" value="カートに入れる" class="button">
                </form>
                    
            </div>
            
        </div>
    </div>
    
<div class="review-area">
    <h2 class="review">Review</h2>
    <div class="review-flex">
        <div class="add-review">
        <h3 class="review-add-title">レビュー投稿</h3>
            <div class="review-add-area">

            
                <form action="{{ route('review.store') }}" method="post">
                    @csrf
                    <h4 class="star-rating">
                        <div class="star-title">評価：</div>
                        <input type="hidden" name="rating" id="rating" value="0">
                        <span data-value="1" class="star">&#9733;</span>
                        <span data-value="2" class="star">&#9733;</span>
                        <span data-value="3" class="star">&#9733;</span>
                        <span data-value="4" class="star">&#9733;</span>
                        <span data-value="5" class="star">&#9733;</span>
                    </h4>
                    <h4 for="comment" class="comment">コメント</h4>

                    <textarea name="comment" id="comment" class="text-input"></textarea>
                    <input type="hidden" name="stock_id" value="{{ $stock->id }}">
                    
                    <button type="submit" class="add-button">レビューを投稿</button>
                </form>
            </div>
        </div>


        <!-- 総合評価の表示 -->



        <!-- 各レビューの表示 -->
        
        <ul class="review-value">
            <h3 class="review-list-title">レビュー一覧</h3>
            <div class="review-list-area">
                @if($stock->reviews && $stock->reviews->isNotEmpty())
                    @foreach($stock->reviews as $review)
                        <li>
                            <div class="star-value">
                                <strong style="">評価</strong>
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="star {{ $i <= $review->rating ? 'filled' : '' }}">★</span>
                                @endfor
                                <strong>{{ $review->rating }}.00</strong>
                          
                                    
                                <div class="year">{{ $review->created_at->format('Y年m月d日') }}</div>

                            </div>
                            <h4 class="review-user-name">投稿者：{{ $review->user->name }}</h4>
                            <p class="review-comment">{{ $review->comment }}</p>
                            
                        </li>
                    @endforeach
                @else
                    <p>まだレビューはありません。</p>
                @endif
            </div>
        </ul>
    </div>
</div>


<script>
    setTimeout(function() {
        var alertMessage = document.getElementById('alert-message');
        if (alertMessage) {
            alertMessage.style.display = 'none';
        }
    }, 4000);


    document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('.star-rating .star');
    const ratingInput = document.getElementById('rating');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const rating = star.getAttribute('data-value');
            ratingInput.value = rating;
            
            // 選択した星までを金色に変更
            stars.forEach(s => s.classList.remove('selected'));
            for (let i = 0; i < rating; i++) {
                stars[i].classList.add('selected');
            }
        });
    });
});

</script>

@endsection
