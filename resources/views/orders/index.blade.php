@extends('layouts.app')
@section('content')
    <h1>Zakázky</h1>
    @if (count($orders) >= 1)
        @foreach ($orders as $order)
            <div class="well">
                <h3><a href="/orders/{{$order->ord_id}}">{{$order->ord_id}}</a></h3>
                <p>{{$order->date_acceptance}}</p></br>
                <p>{{$order->date_handover}}</p>
                <small>Založeno dne {{$order->created_at}}</small>
            </div>
        @endforeach
        {{$orders->links()}}
    @endif
@endsection