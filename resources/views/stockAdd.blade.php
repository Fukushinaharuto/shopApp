@extends('layouts.layout')
@section('content')

<style>
.adds{

}
.add{
    display:flex;

}


</style>

<form action="{{ route('stockAdd') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="adds">
        <div class="add">
            <p><label for="name">商品名：</label></p>
            <p><input type="text" id="name" name="name" required></p>
        </div>
        <div class="add">
            <p><label for="price">number：</label></p>
            <p><input type="number" id="number" name="number" required></p>
        </div>
        <div class="add">
            <p><label for="explain">商品説明：</label></p>
            <p><input type="text" id="explain" name="explain" required></p>
        </div>
        <div class="add">
            <p><label for="price">商品価格：</label></p>
            <p><input type="number" id="price" name="price" required></p>
        </div>
        <div class="add">
            <p><label for="imagePath">商品画像：</label></p>
            <p><input type="file" name="imagePath"></p>
        </div>
        <div id="description-fields">
            <textarea name="descriptions" placeholder="説明を空白で区切って入力" required></textarea>
            <!-- 必要に応じて追加の説明フィールドを追加できます -->
        </div>
        <div class="add">
            <p><label>タグ：</label></p>
            <p>
                @foreach($tags as $tag)
                    <div>
                        <input type="checkbox" id="tag{{ $tag->id }}" name="tags[]" value="{{ $tag->id }}">
                        <label for="tag{{ $tag->id }}">{{ $tag->name }}</label>
                    </div>
                @endforeach
            </p>
        </div>
                <div>
            <button type="submit" class="button">追加</button>
        </div>
</form>
@endsection
