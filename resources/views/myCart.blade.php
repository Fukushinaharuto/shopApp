@extends('layout')
@section('content')
<x-app-layout>
@foreach($myCartStocks as $stock)
    {{$stock->stock_id}}
    {{$stock->user_id}}
@endforeach
</x-app-layout>
@endsection