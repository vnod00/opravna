@extends('layouts.app')
@section('head')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/cs.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script> 
 
@endsection
@section('content')
    <h1>Zaeviduj novou zakázku</h1>
    {!! Form::open(['action' => 'OrderController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Název')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Povinné'])}} 
        </div>
        <div class="form-group">
            {{Form::label('cus_email', 'Zákazník (Hledej dle e-mail)')}}
            
            @include('orders.search_cus')
        </div>   
        <div class="form-group">
            {{Form::label('model_imei', 'IMEI telefonu')}}
            @include('orders.search_mod')
        </div>       
        <div class="form-group">
                {{Form::label('descp', 'Popis vady')}}
                {{Form::textarea('descp', '', [ 'id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Povinné'])}}
        </div>  
        {{Form::submit('Ulož', ['class'=>'btn btn-primary btn-lg active', 'role'=>'button', 'aria-pressed'=>'true'])}}
    {!! Form::close() !!}
    
@endsection