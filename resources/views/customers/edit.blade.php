@extends('layouts.app')
@section('head')

 
@endsection
@section('content')
    <h1>Uprav zakazníka</h1>
    {!! Form::open(['action' => ['CustomerController@update', $cust->cus_id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Jméno nebo název firmy')}}
            {{Form::text('name', $cust->name, ['class' => 'form-control', 'placeholder' => 'Povinné'])}}
        </div>
        <div class="form-group">
            {{Form::label('surname', 'Přijmení')}}
            {{Form::text('surname', $cust->surname, [ 'class' => 'form-control', 'placeholder' => 'Nepovinné'])}}
        </div>
        <div class="form-group">
                {{Form::label('ico', 'IČO')}}
                {{Form::text('ico', $cust->ico, [ 'class' => 'form-control', 'placeholder' => 'Nepovinné'])}}
        </div> 
        <div class="form-group">
                {{Form::label('city', 'Město')}}
                {{Form::text('city', $cust->city, [ 'class' => 'form-control', 'placeholder' => 'Povinné'])}}
        </div> 
        <div class="form-group">
                {{Form::label('street', 'Ulice')}}
                {{Form::text('street', $cust->street, [ 'class' => 'form-control', 'placeholder' => 'Povinné'])}}
        </div> 
        <div class="form-group">
                {{Form::label('house_num', 'Číslo popisné')}}
                {{Form::text('house_num', $cust->house_num, [ 'class' => 'form-control', 'placeholder' => 'Povinné'])}}
        </div> 
        <div class="form-group">
                {{Form::label('post_code', 'PSČ')}}
                {{Form::text('post_code', $cust->post_code, [ 'class' => 'form-control', 'placeholder' => 'Povinné'])}}
        </div> 
        <div class="form-group">
                {{Form::label('phone_num', 'Telefoní číslo')}}
                {{Form::text('phone_num', $cust->phone_num, [ 'class' => 'form-control', 'placeholder' => 'Povinné'])}}
        </div> 
        <div class="form-group">
                {{Form::label('email', 'Email')}}
                {{Form::text('email', $cust->email, [ 'class' => 'form-control', 'placeholder' => 'Povinné'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}    
        {{Form::submit('Ulož', ['class'=>'btn btn-primary btn-lg active', 'role'=>'button', 'aria-pressed'=>'true'])}}
    {!! Form::close() !!}
@endsection