@extends('layouts.app')
@section('content')
    <h1>{{$order->name}}</h1>
    <table class="table">
            <tbody>
              <tr>
                <th scope="row">Zákazník</th>
                <td>{{$order->customer->name}} {{$order->customer->surname}}</td>
              </tr>
              <tr>
                <th scope="row">Model telefonu</th>
                <td>{{$order->model->brand->brand_name}} {{$order->model->model_name}}</td>
              </tr>
              <tr>
                <th scope="row">Závada</th>
                <td>{!!$order->desc!!}</td>
               </tr>
               @foreach ($order->repair as $repair)
               <tr class="bg-warning">
                    <th scope="row">Provedená oprava</th>
                    <td>{{$repair->name}}</td>
               </tr>  
           @endforeach   
            @foreach ($order->task as $task) 
            <tr class="bg-info">
                    <th scope="row">Provedené úkony</th>
                    <td>{{$task->desc}}</td>
            </tr>
        @endforeach 
            </tbody>
    </table>
    @auth
        @if( Auth::user()->hasAnyRole(['admin','prodavac']))
        {!! Form::open(['action' => ['OrderController@destroy', $order->ord_id], 'method' => 'POST', 'class' => 'float-right delete ']) !!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!! Form::close() !!}
        @endif
    @endauth
          <a href="/orders/{{{$order->ord_id}}}/edit" class="btn btn-secondary  mr-2" role="button" aria-pressed="true">Upravit</a>
          <a href="/orders" class="btn btn-primary">Zpět</a>
    <script>
        $(".delete").on("submit", function(){
            return confirm("Opravdu chcete tuto zakázku odstranit??");
        });
    </script>
@endsection

