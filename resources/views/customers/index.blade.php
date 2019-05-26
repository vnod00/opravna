@extends('layouts.app')
@section('content')
    <h1>Zákazníci</h1>
    @if (count($cust) >= 1)
    <ul class="list-group">
        @foreach ($cust as $cus)
            <li class="list-group-item">
                <b>{{$cus->name}} {{$cus->surname}}</b> – {{$cus->email}}
                
                <a href="/customers/{{$cus->cus_id}}" class="btn btn-secondary float-right" role="button" aria-pressed="true">Detail</a> 
            </li>
                                             
        @endforeach
    </ul>
        {{$cust->links()}}
    @endif
@endsection