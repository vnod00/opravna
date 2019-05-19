@extends('layouts.app')
@section('head')


@endsection
@section('content')
    <h1>Uprav zakázku</h1>
    <div class="form-group">
        {!! Form::open(['action' => ['OrderController@destroy',  $order->ord_id], 'method' => 'POST']) !!}
            {{Form::label('rep-done', 'Provedené opravy: ')}}
            @foreach ($order->repair as $done) 
            <small>{{$done->name}}</small>
            
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!! Form::close() !!}          
            @endforeach
            
    </div>
    {!! Form::open(['action' => ['OrderController@update', $order->ord_id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('name', 'Název')}}
        {{Form::text('name', $order->name, ['class' => 'form-control', 'placeholder' => 'Povinné'])}} 
    </div>
    <div class="form-group">
        {{Form::label('cus_name', 'Zákazník (Hledej dle e-mail)')}}
        
        @include('orders.search_cus')
    </div>   
    <div class="form-group">
        {{Form::label('model_name', 'Model telefonu (Hledej dle IMEI)')}}
        @include('orders.search_mod')
    </div>       
    <div class="form-group">
            {{Form::label('descp_ord', 'Popis vady')}}
            {{Form::textarea('descp', $order->desc, [ 'id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Povinné'])}}
    </div>
    
    <div class="form-group" id="repair_div">
        {{Form::label('rep_sel', 'Zadej provedenou opravu')}}
        <div class="input-group mb-3" id="repair">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect01">Vyber provedenou opravu</label>
            </div>
            <select name="rep_sel" class="form-control">
              <option  selected></option>
              @foreach ($repairs as $repair)               
                    <option class="select_option" value="1">{{$repair->name}}</option>                                
              @endforeach 
            </select> 
            
        </div>   
    </div>   
    <div class="form-group">
        {{Form::label('task_sel', 'Zadej změnu na zakázce')}}
        <div class="input-group mb-3">          
            <div class="input-group-prepend">
             <label class="input-group-text" for="inputGroupSelect01">Změny na zakázce</label>
            </div>
            <select name="task_sel" class="form-control" >
             <option  selected></option>
                @foreach ($tasks as $task) 
                    <option >{{$task->desc}}</option>               
                 @endforeach 
            </select>
        </div>
   </div>
   <div class="form-group">
          
        {{Form::file('cover_image')}}
   </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Ulož', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
    <script>
            $(".delete").on("submit", function(){
                return confirm("Opravdu chcete tuto opravu odstranit??");
            });
        </script>
@endsection