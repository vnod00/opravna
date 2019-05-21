@extends('layouts.app')
@section('content')
    <h1>{{$order->name}}</h1>
    <ul class="list-group">
        <li class="list-group-item">Zákazník: {{$order->customer->name}} {{$order->customer->surname}}</li>
        <li class="list-group-item">Model telefonu: {{$order->model->brand->brand_name}} {{$order->model->model_name}}</li>
        <li class="list-group-item">Závada: {!!$order->desc!!}</li>
    </ul>
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
    <hr>
    <small>Založeno dne {{$order->created_at}}</small>
    <a href="/orders" class="btn btn-default">Zpět</a>
    
    {!! Form::open(['action' => ['OrderController@destroy', $order->ord_id], 'method' => 'POST', 'class' => 'float-right delete ']) !!}
    {{Form::hidden('_method', 'DELETE')}}
    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
    {!! Form::close() !!}
    <a href="/orders/{{{$order->ord_id}}}/edit" class="btn btn-secondary float-right mr-2" role="button" aria-pressed="true">Upravit</a>
    <script>
        $(".delete").on("submit", function(){
            return confirm("Opravdu chcete tuto zakázku odstranit??");
        });
    </script>
@endsection

