@extends('layouts.app')
@section('content')
    <h1>Zakázky</h1>
    @if (count($orders) >= 1)
        @foreach ($orders as $order)
            <div class="well">
                <h3><a href="/orders/{{$order->ord_id}}">{{$order->name}}</a></h3>
                <ul class="list-group">
                    <li class="list-group-item">Zákazník: {{$order->customer->name}} {{$order->customer->surname}}</li>
                    <li class="list-group-item">Model telefonu: {{$order->model->brand->brand_name}} {{$order->model->model_name}}</li>
                    <li class="list-group-item">Závada: {!!$order->desc!!}</li>
                    @foreach ($order->repair as $repair)
                                
                                <li class="list-group-item">Provedená oprava: {{$repair->name}}</li>
                            @endforeach
                    @foreach ($order->task as $task) 
                    <li class="list-group-item">Provedené úkony: {{$task->desc}} </li>               
                    @endforeach 
                </ul>                
                @foreach ($order->task_user as $user) 
                    <small>Založil: {{$user->first_name}} {{$user->last_name}}</small>               
                @endforeach            
                <small>Založeno dne: {{$order->created_at}}</small>
                <small>Naposledy upraveno {{$order->updated_at}}</small>
            </div>
        <hr>
        @endforeach
        {{$orders->links()}}
    @endif
@endsection
