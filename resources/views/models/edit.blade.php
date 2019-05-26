@extends('layouts.app')
@section('head')

 
@endsection
@section('content')
    <h1>Uprav telefon</h1>
    {!! Form::open(['action' => ['DeviceModelController@update', $model->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('model', 'Model')}}
            {{Form::text('model', $model->model_name, ['class' => 'form-control', 'placeholder' => 'Povinné'])}}
        </div>
        <div class="form-group">
            {{Form::label('imei', 'IMEI')}}
            {{Form::text('imei', $model->imei, [ 'class' => 'form-control', 'placeholder' => 'Povinné'])}}
        </div>
        <div class="form-group">   
            {{Form::label('brand', 'Výrobce')}}
            @include('models.search')
        </div>
        <div class="form-group">
          
            {{Form::file('cover_image')}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Ulož', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection