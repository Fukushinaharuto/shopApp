@extends('layouts.layout')
@section('content')
    <h1>タグ管理</h1>

    @if (session('message'))
        <p>{{ session('message') }}</p>
    @endif

    <form action="{{ route('tags.store') }}" method="POST">
        @csrf
        <label for="name">新しいタグ名：</label>
        <input type="text" name="name" id="name" required>
        <button type="submit">タグを作成</button>
    </form>

    <h2>既存のタグ</h2>
    <ul>
        @foreach($tags as $tag)
            <li>{{ $tag->name }}</li>
        @endforeach
    </ul>

@endsection