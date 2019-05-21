@extends('layouts.app')
@section('content')
    <h1>Zakázky</h1>
    @if (count($orders) >= 1)
        @foreach ($orders as $order)
                     <table class="table w-50 p-3">
                        <thead class="thead-dark ">
                          <tr>
                            <th scope="col" class="w-50 p-3">ID-{{$order->ord_id}}</th>
                            <th scope="col" class="w-50 p-3">{{$order->name}}</th>                     
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th class="w-50 p-3">Zákazník:</th>
                            <th class="w-50 p-3">{{$order->customer->name}} {{$order->customer->surname}}</th>
                        </tr>
                        </tbody>
                      </table>
                      <a href="/orders/{{{$order->ord_id}}}" class="btn btn-secondary" role="button" aria-pressed="true">Detail</a>
                @foreach ($order->task_user as $user) 
                    <small>Založil: {{$user->first_name}} {{$user->last_name}}</small>               
                @endforeach            
                <small>Založeno dne: {{$order->created_at}}</small>
                <small>Naposledy upraveno {{$order->updated_at}}</small>
        <hr>
        @endforeach
        {{$orders->links()}}
    @endif
@endsection
