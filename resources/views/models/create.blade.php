@extends('layouts.app')
@section('head')

 
@endsection
@section('content')
    <h1>Zaeviduj nový telefon</h1>
    {!! Form::open(['action' => 'DeviceModelController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('model', 'Model')}}
            {{Form::text('model', '', ['class' => 'form-control', 'placeholder' => 'Povinné'])}}
        </div>
        <div class="form-group">
            {{Form::label('imei', 'IMEI')}}
            {{Form::text('imei', '', [ 'class' => 'form-control', 'placeholder' => 'Povinné'])}}
        </div>
        <div class="form-group">   
            {{Form::label('brand', 'Výrobce')}}
            @include('models.search')
        </div>
        <div class="form-group">
          
            {{Form::file('cover_image')}}
        </div>
        {{Form::submit('Ulož', ['class'=>'btn btn-primary btn-lg active', 'role'=>'button', 'aria-pressed'=>'true'])}}
    {!! Form::close() !!}
@endsection