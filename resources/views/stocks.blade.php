@extends('layout')
@section('content')
<x-app-layout>
@foreach($stocks as $stock)
    <table>
        <tr>
            <th>{{$stock->name}}</th>
            <td>{{$stock->price}}円</td>
            <td>{{$stock->explain}}</td>
            <form action="addMyCart" method='post'>
                @csrf
                <input type="hidden" name="stock_id" value=" {{ $stock->id }}">
                <input type="submit" value="カートに入れる">
            </form>
        </tr>

    </table>
@endforeach

{{$stocks->links()}}
</x-app-layout>
@endsection