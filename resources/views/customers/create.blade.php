@extends('layouts.app')
@section('head')

 
@endsection
@section('content')
    <h1>Zaeviduj nového zakazníka</h1>
    {!! Form::open(['action' => 'CustomerController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Jméno')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Povinné'])}}
        </div>
        <div class="form-group">
            {{Form::label('surname', 'Přijmení')}}
            {{Form::text('surname', '', [ 'class' => 'form-control', 'placeholder' => 'Povinné'])}}
        </div>
        <div class="form-group">
                {{Form::label('ico', 'IČO')}}
                {{Form::text('ico', '', [ 'class' => 'form-control', 'placeholder' => 'Nepovinné'])}}
        </div> 
        <div class="form-group">
                {{Form::label('city', 'Město')}}
                {{Form::text('city', '', [ 'class' => 'form-control', 'placeholder' => 'Povinné'])}}
        </div> 
        <div class="form-group">
                {{Form::label('street', 'Ulice')}}
                {{Form::text('street', '', [ 'class' => 'form-control', 'placeholder' => 'Povinné'])}}
        </div> 
        <div class="form-group">
                {{Form::label('house_num', 'Číslo popisné')}}
                {{Form::text('house_num', '', [ 'class' => 'form-control', 'placeholder' => 'Povinné'])}}
        </div> 
        <div class="form-group">
                {{Form::label('post_code', 'PSČ')}}
                {{Form::text('post_code', '', [ 'class' => 'form-control', 'placeholder' => 'Povinné'])}}
        </div> 
        <div class="form-group">
                {{Form::label('phone_num', 'Telefoní číslo')}}
                {{Form::text('phone_num', '', [ 'class' => 'form-control', 'placeholder' => 'Povinné'])}}
        </div> 
        <div class="form-group">
                {{Form::label('email', 'Email')}}
                {{Form::text('email', '', [ 'class' => 'form-control', 'placeholder' => 'Povinné'])}}
        </div>    
        {{Form::submit('Ulož', ['class'=>'btn btn-primary btn-lg active', 'role'=>'button', 'aria-pressed'=>'true'])}}
    {!! Form::close() !!}
@endsection