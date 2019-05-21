@extends('layouts.app')
@section('head')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/cs.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script> 

@endsection
@section('content')
    <h1>Uprav zakázku</h1>
    <div class="form-group">
         @foreach ($order->repair as $done) 
        {!! Form::open(['action' => ['OrderController@destroyRepair',  $order->ord_id, $done->rep_id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            {{Form::label('rep-done', 'Provedené opravy: ')}}
            
            {{Form::label('name', $done->name)}}
            
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
        {{Form::label('cus_email', 'Zákazník (Hledej dle e-mail)')}}
        
        @include('orders.search_cus')
    </div>   
    <div class="form-group">
        {{Form::label('model_imei', 'IMEI telefonu')}}
        @include('orders.search_mod')
    </div>
    <div class="container">
    <div class="row">
        <div class="form-group col pl-0">
            {{Form::label('acc_date', 'Datum přijetí')}}
            {{Form::text('acc_date', $order->date_acceptance, ['class' => 'form-control date', 'id'=>'datepicker']) }}
        </div>
        <div class="form-group col pr-0">
            {{Form::label('hand_date', 'Datum vyhotovení')}}
            {{Form::text('hand_date', null, ['class' => 'form-control date', 'id'=>'datepicker2']) }}
        </div>
    </div>
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
                    <option >{{$repair->name}}</option>                                
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