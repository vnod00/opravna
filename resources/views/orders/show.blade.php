@extends('layouts.app')
@section('content')
    <h1>{{$order->ord_id}}</h1>
    <p>{{$order->date_acceptance}}</p></br>
    <p>{{$order->date_handover}}</p>
    <hr>
    <small>Založeno dne {{$order->created_at}}</small>
    <a href="/orders" class="btn btn-default">Zpět</a>
@endsection