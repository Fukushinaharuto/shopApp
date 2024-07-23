@extends('layout')
@section('content')
@foreach($stocks as $stock)
    <table>
        <tr>
            <th>{{$stock->name}}</th>
            <td>{{$stock->price}}円</td>
            <td>{{$stock->explain}}</td>
        </tr>
    </table>
@endforeach
{{$stocks->links()}}
@endsection