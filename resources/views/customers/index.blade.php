@extends('layouts.app')
@section('content')
    <h1>Zákazníci</h1>
    @if (count($cust) >= 1)
        @foreach ($cust as $cus)
            <div class="well">
                <h3><a href="/orders/{{$cus->cus_id}}">{{$cus->name}} {{$cus->surname}}</a></h3>
                <p>{{$cus->city}}</p></br>
                <p>{{$cus->ico}}</p>
                <small>Založen dne {{$cus->created_at}}</small>
            </div>
        @endforeach
        {{$cust->links()}}
    @endif
@endsection